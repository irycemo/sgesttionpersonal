<?php

namespace App\Livewire\Formatos;

use App\Models\Persona;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class Formatos extends Component
{

    public $formato;
    public $fecha1;
    public $fecha2;
    public $hora1;
    public $hora2;
    public $dias;
    public $empleados;
    public $estructura;
    public $empleado;
    public $autoriza;
    public $observaciones;
    public $rules = [];

    public $flags = [
        'fecha1' => false,
        'fecha2' => false,
        'hora1' => false,
        'hora2' => false,
        'dias' => false,
        'observaciones' => false
    ];

    protected function rules(){
        return [
            'empleado' => 'required',
            'autoriza' => 'required',
            'formato' => 'required',
         ];
    }

    protected $validationAttributes = [
        'fecha1' => 'fecha inicial',
        'fecha2' => 'fecha final',
    ];

    public function updatedFormato(){

        if($this->formato == 'economico'){

            $this->flags['fecha1'] = true;
            $this->flags['fecha2'] = true;
            $this->flags['hora1'] = false;
            $this->flags['hora2'] = false;
            $this->flags['dias'] = true;

            $this->rules = [
                'dias' => 'required_if:formato,economico',
                'fecha1' => 'required',
                'fecha2' => 'required',
            ];

        }elseif($this->formato == 'salida'){

            $this->flags['fecha1'] = false;
            $this->flags['fecha2'] = false;
            $this->flags['hora1'] = true;
            $this->flags['hora2'] = true;
            $this->flags['dias'] = false;

            $this->rules = [
                'hora1' => 'required',
            ];

        }

    }

    public function mount(){

        $this->empleados = Persona::where('status', 'activo')
                                        ->where('tipo', '!=', 'estructura')
                                        ->orderBy('ap_paterno')
                                        ->get();

        $this->estructura = Persona::where('tipo', 'estructura')->orderBy('nombre')->get();
    }

    public function crear(){

        $this->validate(array_merge($this->rules(), $this->rules));

        $empleado = json_decode($this->empleado,true);

        $pdf = Pdf::loadView('formatos.' . $this->formato, [
            'fecha1' => $this->fecha1,
            'fecha2' => $this->fecha2,
            'hora1' => $this->hora1,
            'hora2' => $this->hora2,
            'dias' => $this->dias,
            'empleado' => $empleado['nombre'] . ' ' . $empleado['ap_paterno'] . ' ' . $empleado['ap_materno'],
            'departamento' => $empleado['area'],
            'autoriza' => $this->autoriza,
            'observaciones' => $this->observaciones
        ])->output();

        return response()->streamDownload(
            fn () => print($pdf),
            'Formato.pdf'
        );
    }

    public function render()
    {
        return view('livewire.formatos.formatos')->extends('layouts.admin');
    }
}
