<?php

namespace App\Livewire\Asignacion;

use Exception;
use Carbon\Carbon;
use App\Models\Inhabil;
use App\Models\Permiso;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Incidencia;
use App\Models\PermisoPersona;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\JustificacionService;

class Asignacion extends Component
{

    public $permisos;
    public $permiso_id;
    public $permiso_seleccionado;
    public $empleados;
    public $empleado_id;
    public $empleado_seleccionado;
    public $flag_catastro = false;
    public $fecha_inicial;
    public $fecha_final;

    protected function rules(){
        return [
            'empleado_id' => 'required',
            'permiso_id' => 'required',
            'fecha_inicial' => 'required',
            'fecha_final' => [
                                'nullable',
                                Rule::requiredIf($this->permiso_seleccionado?->tipo == 'personal' && $this->empleado_seleccionado?->localidad == 'Catastro'),
                                'after_or_equal:fecha_inicial'
                            ],
         ];
    }

    protected $validationAttributes  = [
        'empleado_id' => 'empleado',
        'permiso_id' => 'permiso',
        'fecha_inicial' => 'fecha inicial',
        'fecha_final' => 'fecha final'
    ];

    public function updatedPermisoId(){

        $this->reset(['flag_catastro', 'empleado_seleccionado', 'empleado_id']);

        $this->permiso_seleccionado = Permiso::find($this->permiso_id);

    }

    public function updatedEmpleadoId(){

        $this->reset(['flag_catastro']);

        $this->empleado_seleccionado = Persona::find($this->empleado_id);

        if($this->empleado_seleccionado->localidad == 'Catastro' && $this->permiso_seleccionado->tipo == 'personal') $this->flag_catastro = true;

    }

    public function asignarPermiso(){

        $this->validate();

        try {

            $this->buscarPermiso();

            DB::transaction(function () {

                if($this->permiso_seleccionado->tipo == 'personal') $this->asignarPermisoPersonal();

                if($this->permiso_seleccionado->tipo == 'oficial') $this->asignarPermisoOficial();

            });

            $this->dispatch('mostrarMensaje', ['success', "Se asignó el permiso correctamente."]);

            $this->reset(['permiso_id', 'permiso_seleccionado', 'empleado_id', 'empleado_seleccionado', 'flag_catastro', 'fecha_inicial', 'fecha_final']);

        } catch (Exception $ex) {

            Log::error("Error al asignar permiso por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $ex);

            $this->dispatch('mostrarMensaje', ['error', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al asignar permiso por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function buscarPermiso(){

        if($this->fecha_final){

            $permisoAsignado = PermisoPersona::where('persona_id', $this->empleado_id)
                                                ->where('fecha_inicio', '>=', Carbon::parse($this->fecha_inicial)->format('Y-m-d') . ' 00:00:00')
                                                ->where('fecha_final', '<=', Carbon::parse($this->fecha_final)->format('Y-m-d') . ' 23:59:59')
                                                ->first();

        }else{

            $permisoAsignado = PermisoPersona::where('persona_id', $this->empleado_id)
                                                ->where('fecha_inicio', '>=', Carbon::parse($this->fecha_inicial)->format('Y-m-d') . ' 00:00:00')
                                                ->where('fecha_final', '<=', Carbon::parse($this->fecha_inicial)->format('Y-m-d') . ' 23:59:59')
                                                ->first();

        }

        if($permisoAsignado) throw new Exception('Ya tiene un permiso asignado que cobre esa fecha.');

    }

    public function asignarPermisoOficial(){

        if($this->permiso_seleccionado->tiempo > 24){

            $dias = $this->permiso_seleccionado->tiempo / 24;

            $final = Carbon::createFromFormat('Y-m-d', $this->fecha_inicial);

            for ($i=0; $i < $dias; $i++) {

                $final->addDay();

                $inhabil = Inhabil::whereDate('fecha', $final->format('Y-m-d'))->first();

                while($inhabil != null){

                    $final->addDay();
                    $inhabil = Inhabil::whereDate('fecha', $final->format('Y-m-d'))->first();

                }

                while($final->isWeekend()){

                    $final->addDay();

                }

            }

        }else{

            $final = Carbon::parse($this->fecha_inicial);

        }

        PermisoPersona::create([
            'creado_por' => auth()->id(),
            'fecha_inicio' => $this->fecha_inicial,
            'fecha_final' => $final->toDateString(),
            'permiso_id' => $this->permiso_id,
            'persona_id' => $this->empleado_id
        ]);

        (new JustificacionService())->justificarFalta(
                                            $this->empleado_id,
                                            $this->fecha_inicial,
                                            $final->toDateString(),
                                            "Se justifica falta mediante permiso " .
                                            $this->permiso_seleccionado->tipo . " " .
                                            $this->permiso_seleccionado->descripcion .
                                            " registrado por: " . auth()->user()->name .
                                            " con fecha de " . now()->format('d-m-Y H:i:s')
                                        );

        (new JustificacionService())->justificarRetardo(
                                        $this->empleado_id,
                                        $this->fecha_inicial,
                                        $final->toDateString(),
                                        "Se justifica falta mediante permiso " .
                                        $this->permiso_seleccionado->tipo . " " .
                                        $this->permiso_seleccionado->descripcion .
                                        " registrado por: " . auth()->user()->name .
                                        " con fecha de " . now()->format('d-m-Y H:i:s')
                                    );

        $incidencias = Incidencia::where('persona_id', $this->empleado_id)
                                    ->whereBetween('created_at', [$this->fecha_inicial, $final->toDateString()])
                                    ->get();

        foreach ($incidencias as $incidencia) {

            $incidencia->delete();

        }

    }

    public function asignarPermisoPersonal(){

        $ff = Carbon::parse($this->fecha_final);
        $fi = Carbon::parse($this->fecha_inicial);

        if($this->empleado_seleccionado->localidad === 'Catastro'){

            PermisoPersona::create([
                'creado_por' => auth()->id(),
                'fecha_inicio' => $this->fecha_inicial,
                'fecha_final' => $this->fecha_final,
                'permiso_id' => $this->permiso_id,
                'persona_id' => $this->empleado_id,
                'tiempo_consumido' => $fi->diffInMinutes($ff)
            ]);

        }else{


            if(now()->isSameDay($this->fecha_inicial)){

                PermisoPersona::create([
                    'creado_por' => auth()->id(),
                    'fecha_inicio' => $this->fecha_inicial,
                    'permiso_id' => $this->permiso_id,
                    'persona_id' => $this->empleado_id
                ]);

            }else{

                PermisoPersona::create([
                    'creado_por' => auth()->id(),
                    'fecha_inicio' => $this->fecha_inicial,
                    'fecha_final' => $this->fecha_inicial,
                    'permiso_id' => $this->permiso_id,
                    'persona_id' => $this->empleado_id,
                    'tiempo_consumido' => $this->tiempoConsumido()
                ]);
            }

        }

        (new JustificacionService())->justificar(
                                        $this->empleado_id,
                                        Carbon::parse($this->fecha_inicial)->format('Y-m-d'),
                                        Carbon::parse($this->fecha_inicial)->format('Y-m-d'),
                                        "Se justifica falta mediante permiso " .
                                        $this->permiso_seleccionado->tipo . " " .
                                        $this->permiso_seleccionado->descripcion .
                                        " registrado por: " . auth()->user()->name .
                                        " con fecha de " . now()->format('d-m-Y H:i:s')
                                    );

        $incidencia = Incidencia::where('persona_id', $this->empleado_id)
                                    ->whereDate('created_at', Carbon::parse($this->fecha_inicial)->format('Y-m-d'))
                                    ->first();

        if($incidencia) $incidencia->delete();

    }

    public function tiempoConsumido(){

        $ultimaChecada = $this->empleado_seleccionado->checados()->whereDate('created_at', $this->fecha_inicial)->first();

        if($ultimaChecada?->tipo == 'salida'){

            $dia = $ultimaChecada->created_at->format('l');

            $horaChecada = $ultimaChecada->created_at;

            /* Crear fecha de checado + la hora del dia en el horario */
            $horaSalida = Carbon::createFromFormat('Y-m-d H:i:s', $horaChecada->format('Y-m-d') . ' ' . $this->obtenerDia($this->empleado_seleccionado->horario, $dia));

            if($horaSalida > $horaChecada){

                return $horaSalida->diffInMinutes($horaChecada);

            }

        }else{

            return null;

        }

    }

    public function obtenerDia($horario, $dia){

        $a =  [
            'Monday' => 'lunes_salida',
            'Tuesday' => 'martes_salida',
            'Wednesday' => 'miercoles_salida',
            'Thursday' => 'jueves_salida',
            'Friday' => 'viernes_salida'
        ][$dia];

        return $horario[$a];

    }

    public function mount(){

        $this->permisos = Permiso::orderBy('descripcion')->get();

        $this->empleados = Persona::select('id', 'nombre', 'ap_paterno', 'ap_materno')
                                        ->when(!auth()->user()->hasRole(['Administrador', 'Contador(a)', 'Delegado(a) Administrativo(a)']), function($q){
                                            $q->where('localidad', auth()->user()->localidad);
                                        })
                                        ->where('status', 'activo')
                                        ->orderBy('nombre')
                                        ->get();

    }

    public function render()
    {
        return view('livewire.asignacion.asignacion')->extends('layouts.admin');
    }
}
