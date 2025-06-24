<?php

namespace App\Livewire\Personal;

use App\Models\Horario;
use App\Models\Persona;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Constantes\Constantes;
use App\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Personal extends Component
{

    use WithPagination;
    use WithFileUploads;
    use ComponentesTrait;

    public Persona $modelo_editar;

    public $horarios;
    public $localidades;
    public $areas;
    public $tipos;
    public $foto;

    protected $queryString = ['search'];

    protected function rules(){
        return [
            'modelo_editar.numero_empleado' => 'required|numeric|unique:personas,numero_empleado,' . $this->modelo_editar->id,
            'modelo_editar.nombre' => [
                            'required',
                            'regex:/^[a-zA-Z0-9\s]+$/'
                        ],
            'modelo_editar.ap_paterno' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'modelo_editar.ap_materno' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'modelo_editar.status' => 'required',
            'modelo_editar.codigo_barras' => 'min:1|sometimes|numeric|unique:personas,codigo_barras,' . $this->modelo_editar->id,
            'modelo_editar.localidad' => 'required',
            'modelo_editar.area' => 'required',
            'modelo_editar.tipo' => 'required',
            'modelo_editar.telefono' => 'nullable|unique:personas,telefono,' . $this->modelo_editar->id,
            'modelo_editar.domicilio' => 'required',
            'modelo_editar.email' => 'nullable|email:rfc,dns|unique:personas,email,' . $this->modelo_editar->id,
            'modelo_editar.fecha_ingreso' => 'required',
            'modelo_editar.horario_id' => 'required',
            'modelo_editar.observaciones' => 'nullable',
            'foto' => 'nullable|mimes:jpg,png,jpeg',
            'modelo_editar.rfc' => [
                        'unique:personas,rfc,' . $this->modelo_editar->id,
                        'required',
                        'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/'
                    ],
            'modelo_editar.curp' => [
                        'unique:personas,curp,' . $this->modelo_editar->id,
                        'required',
                        'regex:/^[A-Z]{1}[AEIOUX]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/i'
                    ],
         ];
    }

    protected $validationAttributes  = [
        'modelo_editar.rfc' => 'RFC',
        'modelo_editar.curp' => 'CURP',
        'modelo_editar.horario_id' => 'horario',
        'modelo_editar.paterno' => 'apellido paterno',
        'modelo_editar.materno' => 'apellido materno',
        'modelo_editar.telefono' => 'teléfono',
        'modelo_editar.numero_empleado' => 'número de empleado',
        'modelo_editar.codigo_barras' => 'código de barras',
        'modelo_editar.area' => 'área',
    ];

    public function crearModeloVacio(){
        $this->modelo_editar = Persona::make();
    }

    public function abrirModalEditar(Persona $modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

    }

    public function guardar(){

        $this->validate();

        $empleado = Persona::where('nombre', $this->modelo_editar->nombre)->where('ap_paterno', $this->modelo_editar->ap_paterno)->where('ap_materno', $this->modelo_editar->ap_materno)->first();

        if($empleado){

            $this->dispatch('mostrarMensaje', ['error', "Ya esta registrado un empleado con ese nombre."]);

            $this->resetearTodo();

            return;

        }

        try {

            if($this->foto){

                $nombreArchivo = $this->foto->store('/', 'personal');

                $this->dispatch('removeFiles');

                $this->modelo_editar->foto = $nombreArchivo;

            }

            $this->modelo_editar->creado_por = auth()->user()->id;

            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El empleado se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear empleado por el usuario: " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }
    }

    public function actualizar(){

        $this->validate();

        try{

            if($this->foto){

                if($this->modelo_editar->foto) Storage::disk('personal')->delete($this->modelo_editar->foto);

                $nombreArchivo = $this->foto->store('/', 'personal');

                $this->dispatch('removeFiles');

                $this->modelo_editar->foto = $nombreArchivo;

            }

            $this->modelo_editar->actualizado_por = auth()->user()->id;
            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El empleado se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar empleado por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $empleado = Persona::find($this->selected_id);

            if($empleado->foto) Storage::disk('personal')->delete($empleado->foto);

            $empleado->delete();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El empleado se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar empleado por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }
    }

    public function mount(){

        $this->crearModeloVacio();

        $this->horarios = Horario::all();

        $this->localidades = Constantes::LOCALIDADES;

        $this->areas = Constantes::AREAS_ADSCRIPCION;

        $this->tipos = Constantes::TIPO;

    }

    public function render()
    {

        $personas = Persona::with('horario', 'creadoPor', 'actualizadoPor')
                                ->when(auth()->user()->hasRole(['Jefe de departamento']), function($q){
                                    $q->where('area', auth()->user()->ubicacion);
                                })
                                ->where(function($q){
                                    $q->where('numero_empleado', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('nombre', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('status', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('ap_paterno', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('ap_materno', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('codigo_barras', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('localidad', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('area', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('tipo', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('rfc', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('curp', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('telefono', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('domicilio', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('fecha_ingreso', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere(function($q){
                                        return $q->whereHas('horario', function($q){
                                            return $q->where('tipo', 'LIKE', '%' . $this->search . '%');
                                        });
                                    })
                                    ->orWhere('observaciones', 'LIKE', '%' . $this->search . '%');
                                })
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);

        return view('livewire.personal.personal', compact('personas'))->extends('layouts.admin');
    }
}
