<?php

namespace App\Livewire\Checador;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Persona;
use App\Models\Retardo;
use Livewire\Component;
use App\Models\Checador as CH;

class Checador extends Component
{

    public $persona;
    public $codigo;
    public $checados;
    public $flag = false;

    public function capturarCodigo(){

        $this->flag = false;

        $hora = now();

        $this->persona = Persona::where('codigo_barras', $this->codigo)->first();

        if($this->persona == null || $this->codigo == null){

            $this->dispatch('mostrarMensaje', ['error', "No se encuentra la persona ó código incorrecto."]);

            $this->codigo = null;

            return;

        }

        /* $permiso = $this->persona->permisos()->where('tipo', 'oficial')->where('tiempo', '!=', 0)->where('fecha_inicio','<=', now()->format('Y-m-d'))->where('fecha_final','>=', now()->format('Y-m-d'))->get();

        $incapacidad = Incapacidad::where('persona_id', $this->persona->id)->where('fecha_inicial','<=', now()->format('Y-m-d'))->where('fecha_final','>=', now()->format('Y-m-d'))->get();

        if($permiso->count() > 0 || $incapacidad->count() > 0){

            $this->dispatch('mostrarMensaje', ['error', "El empleado no puede hacer registros mientras tenga permiso oficial o incapacidad."]);

            $this->codigo = null;

            return;
        } */

        $this->checados = CH::where('persona_id', $this->persona->id)->whereDate('created_at', '=', Carbon::today()->toDateString())->get();

        if($this->checados->count() > 0){

            if($this->checados->last()->created_at->diffInMinutes(now()) > 1){

                if($this->checados->last()->tipo == 'entrada'){

                    $this->checar($hora, 'salida');

                }else{

                    $this->checar($hora, 'entrada');

                }

            }else{

                $this->dispatch('mostrarMensaje', ['error', "Debe esperar almenos 1 minutos para hacer un nuevo registro."]);

            }

        }else{

            $ch = $this->checar($hora, 'entrada');

            $this->retardoFalta($ch);

        }

        $this->checados = CH::where('persona_id', $this->persona->id)->whereDate('created_at', '=', Carbon::today()->toDateString())->get();

        $this->flag = true;

        $this->dispatch('contador');

        $this->codigo = null;

    }

    public function checar($hora, $tipo){

        $this->checarPermiso($tipo);

        $ch = CH::create([
            'hora' => $hora,
            'tipo' => $tipo,
            'persona_id' => $this->persona->id,
            'ip' => request()->ip()
        ]);

        $this->dispatch('mostrarMensaje', ['success', "Registro exitoso."]);

        return $ch;

    }

    public function retardoFalta($checador){

        /* Horario del empleado */
        $horario = $this->persona->horario;

        /* Si la hora de checada es menor a la hora de entrada finaliza la función */
        if($checador->created_at->lt($this->obtenerDia($horario))){

            return;

        }

        /* Diferencia en minutos de la hora de checada y la hora de entrada */
        $hr = abs($checador->created_at->diffInMinutes($this->obtenerDia($horario)));

        if($horario->falta < $hr){

            if($this->persona->tipo != 'Estructura')

                Falta::create([
                    'tipo' => 'LLegada despues de la hora de tolerancia para falta.',
                    'persona_id' => $this->persona->id
                ]);

        }elseif($horario->tolerancia < $hr){

            Retardo::create([
                'status' => 1,
                'persona_id' => $this->persona->id
            ]);
        }

    }

    public function obtenerDia($horario){

        $a =  [
            'Monday' => 'lunes_entrada',
            'Tuesday' => 'martes_entrada',
            'Wednesday' => 'miercoles_entrada',
            'Thursday' => 'jueves_entrada',
            'Friday' => 'viernes_entrada'
        ][now()->format('l')];

        return $horario[$a];

    }

    public function checarPermiso($tipo){

        $permiso = $this->persona->permisos()
                                    ->where('tipo', 'personal')
                                    ->where('tiempo_consumido', null)
                                    ->whereDate('fecha_inicio', now()->toDateString())
                                    ->first();

        if($permiso && $tipo == 'entrada'){

            if(count($this->persona->checados) > 0){

                if($this->persona->checados->last()->created_at->isSameDay(now()) && $this->persona->checados->last()->tipo == 'salida'){

                    $permiso->pivot->tiempo_consumido = now()->diffInMinutes($this->persona->checados->last()->created_at);

                    $permiso->pivot->save();

                }

            }

        }

    }

    public function render()
    {
        return view('livewire.checador.checador');
    }
}
