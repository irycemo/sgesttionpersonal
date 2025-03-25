<?php

namespace App\Livewire\Reportes;

use Livewire\Component;

class Reportes extends Component
{

    public $area;
    public $fecha1;
    public $fecha2;

    public $verPermisos = false;
    public $verIncapacidades = false;
    public $verJustificaciones = false;
    public $verPersonal = false;
    public $verFaltas = false;
    public $verRetardos = false;
    public $verChecados = false;
    public $verIncidencias = false;

    protected function rules(){
        return [
            'fecha1' => 'required|date',
            'fecha2' => 'required|date|after:date1',
         ];
    }

    protected $messages = [
        'fecha1.required' => "La fecha inicial es obligatoria.",
        'fecha2.required' => "La fecha final es obligatoria.",
    ];

    public function updatedArea(){

        if($this->area == 'inasistencias'){


            $this->verPermisos = false;
            $this->verIncapacidades = false;
            $this->verJustificaciones = false;
            $this->verPersonal = false;
            $this->verRetardos = false;
            $this->verFaltas = false;
            $this->verChecados = false;
            $this->verIncidencias = false;

        }elseif($this->area == 'permisos'){

            $this->reset([
                'verIncapacidades',
                'verJustificaciones',
                'verPersonal',
                'verFaltas',
                'verChecados',
                'verRetardos',
                'verIncidencias',
            ]);

            $this->verPermisos = true;

        }elseif($this->area == 'incapacidades'){

            $this->reset([
                'verPermisos',
                'verJustificaciones',
                'verPersonal',
                'verFaltas',
                'verChecados',
                'verRetardos',
                'verIncidencias',
            ]);

            $this->verIncapacidades = true;

        }elseif($this->area == 'justificaciones'){

            $this->reset([
                'verPermisos',
                'verIncapacidades',
                'verPersonal',
                'verFaltas',
                'verChecados',
                'verRetardos',
                'verIncidencias',
            ]);

            $this->verJustificaciones = true;

        }elseif($this->area == 'personal'){

            $this->reset([
                'verPermisos',
                'verIncapacidades',
                'verJustificaciones',
                'verFaltas',
                'verChecados',
                'verRetardos',
                'verIncidencias',
            ]);

            $this->verPersonal = true;

        }elseif($this->area == 'faltas'){

            $this->reset([
                'verPermisos',
                'verIncapacidades',
                'verJustificaciones',
                'verPersonal',
                'verChecados',
                'verRetardos',
                'verIncidencias',
            ]);

            $this->verFaltas = true;

        }elseif($this->area == 'retardos'){

            $this->reset([
                'verPermisos',
                'verIncapacidades',
                'verJustificaciones',
                'verPersonal',
                'verChecados',
                'verFaltas',
                'verIncidencias',
            ]);

            $this->verRetardos = true;

        }elseif($this->area == 'checados'){

            $this->reset([
                'verPermisos',
                'verIncapacidades',
                'verJustificaciones',
                'verPersonal',
                'verRetardos',
                'verFaltas',
                'verIncidencias',
            ]);

            $this->verChecados = true;

        }elseif($this->area == 'incidencias'){

            $this->reset([
                'verPermisos',
                'verIncapacidades',
                'verJustificaciones',
                'verPersonal',
                'verRetardos',
                'verFaltas',
                'verChecados',
            ]);

            $this->verIncidencias = true;

        }

    }

    public function mount(){

        $this->area = request()->query('area');

        $this->fecha1 = request()->query('fecha1');

        $this->fecha2 = request()->query('fecha2');

        $this->updatedArea();

    }

    public function render()
    {
        return view('livewire.reportes.reportes')->extends('layouts.admin');
    }
}
