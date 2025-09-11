<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Retardo;
use Livewire\Component;
use App\Models\Incapacidad;
use App\Models\Justificacion;
use Illuminate\Support\Facades\DB;

class Estadisticas extends Component
{

    public $faltas;
    public $permisos;
    public $retardos;
    public $justificaciones;
    public $incapacidades;

    public function placeholder()
    {
        return view('livewire.dashboard.estadisticas-placeholder');
    }

    public function mount(){

        $this->faltas = Falta::whereMonth('created_at', Carbon::now()->month)->count();

        $this->permisos = DB::table('permiso_persona')->whereMonth('created_at', Carbon::now()->month)->count();

        $this->retardos = Retardo::whereMonth('created_at', Carbon::now()->month)->count();

        $this->justificaciones = Justificacion::whereMonth('created_at', Carbon::now()->month)->count();

        $this->incapacidades = Incapacidad::whereMonth('created_at', Carbon::now()->month)->count();

    }

    public function render()
    {
        return view('livewire.dashboard.estadisticas');
    }
}
