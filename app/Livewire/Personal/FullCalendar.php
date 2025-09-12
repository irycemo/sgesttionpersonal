<?php

namespace App\Livewire\Personal;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Retardo;
use Livewire\Component;
use App\Models\Checador;
use App\Models\Incidencia;
use App\Models\Incapacidad;
use App\Models\Justificacion;
use App\Models\PermisoPersona;

class FullCalendar extends Component
{

    public $persona_id;
    public $mes;
    public $events;
    public $evento;

    public $modal;

    public function abrirModalEvento($info){

        $this->evento = $info['event'];

        $this->modal = true;

    }

    public function cargarEventos(){

        $eventos = [];

        $incapacidades = Incapacidad::with('creadoPor:id,name')->where('persona_id', $this->persona_id)->get();

        foreach ($incapacidades as $incapacidad) {

            $eventos [] = [
                'title' => 'Incapacidad',
                'start' => $incapacidad->fecha_inicial,
                'end' => $incapacidad->fecha_final,
                'tipo' => $incapacidad->tipo,
                'registrado_por' => $incapacidad->creadoPor->name,
                'observaciones' => $incapacidad->observaciones,
                'color' =>  '#156064'
            ];

        }

        $incidencias = Incidencia::where('persona_id', $this->persona_id)->get();

        foreach ($incidencias as $incidencia) {

            $eventos [] = [
                'title' => 'Incidencia',
                'tipo' => $incidencia->tipo,
                'start' => Carbon::parse($incidencia->created_at)->format('Y-m-d'),
                'color' =>  '#E08F38'
            ];

        }

        $justificaciones = Justificacion::with('creadoPor:id,name','falta', 'retardo')->where('persona_id', $this->persona_id)->get();

        foreach ($justificaciones as $justificacion) {

            $eventos [] = [
                'title' => 'Jutificación',
                'start' => Carbon::parse($justificacion->created_at)->format('Y-m-d'),
                'registrado_por' => $justificacion->creadoPor->name,
                'falta' => $justificacion->falta?->created_at,
                'tipo_falta' => $justificacion->falta?->tipo,
                'retardo' => $justificacion->retardo?->created_at,
                'color' =>  '#00C49A'
            ];

        }

        $permisos = PermisoPersona::with('creadoPor:id,name', 'permiso:id,descripcion')->where('persona_id', $this->persona_id)->get();

        foreach ($permisos as $permiso) {

            if($permiso->fecha_final){

                $eventos [] = [
                    'title' => 'Permiso',
                    'start' => Carbon::parse($permiso->fecha_inicio)->format('Y-m-d'),
                    'end' => Carbon::parse($permiso->fecha_final)->format('Y-m-d'),
                    'registrado_por' => $permiso->creadoPor?->name,
                    'tipo' => $permiso->permiso->descripcion,
                    'color' =>  '#F89D9C'
                ];

            }else{

                $eventos [] = [
                    'title' => 'Permiso',
                    'start' => Carbon::parse($permiso->fecha_inicio)->format('Y-m-d'),
                    'registrado_por' => $permiso->creadoPor?->name,
                    'tipo' => $permiso->permiso->descripcion,
                    'color' =>  '#F89D9C'
                ];

            }

        }

        $faltas = Falta::where('persona_id', $this->persona_id)->get();

        foreach ($faltas as $falta) {

            $eventos [] = [
                'title' => 'Falta',
                'start' => Carbon::parse($falta->created_at)->format('Y-m-d'),
                'color' =>  '#F8C06C',
                'tipo' => $falta->tipo
            ];

        }

        $retardos = Retardo::where('persona_id', $this->persona_id)->get();

        foreach ($retardos as $retardo) {

            $eventos [] = [
                'title' => 'Retardo',
                'start' => Carbon::parse($retardo->created_at)->format('Y-m-d'),
                'color' =>  '#F8C06C'
            ];

        }

        $checados = Checador::where('persona_id', $this->persona_id)->get();

        /* $checados = Checador::where('persona_id', $this->persona_id)->whereMonth('created_at', Carbon::createFromFormat('Y-m-d', $this->mes . '-01'))->get(); */

        foreach ($checados as $checado) {

            $eventos [] = [
                'title' => ucfirst($checado->tipo) . ' ' . $checado->created_at->format('H:i:s'),
                'start' => $checado->created_at->format('Y-m-d'),
            ];

        }

        return $eventos;

    }

    public function updatedMes(){

        if($this->mes == "") return;

        $this->changeEvents($this->cargarEventos());

        $this->dispatch('refreshCalendar');

    }

    public function changeEvents($events){

        $this->events = json_encode($events);

    }

    public function mount(){

        $this->mes = now()->format('Y-m');

        $this->changeEvents($this->cargarEventos());

    }

    public function render()
    {
        return view('livewire.personal.full-calendar');
    }

}
