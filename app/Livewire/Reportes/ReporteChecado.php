<?php

namespace App\Livewire\Reportes;

use App\Models\Horario;
use App\Models\Persona;
use Livewire\Component;
use Livewire\WithPagination;
use App\Constantes\Constantes;
use Illuminate\Support\Facades\Log;

class ReporteChecado extends Component
{

    use WithPagination;

    public $fecha1;
    public $fecha2;

    public $status;
    public $empleados;
    public $empleado_id;
    public $localidades;
    public $localidad;
    public $areas;
    public $area;
    public $tipos;
    public $tipo;
    public $horarios;
    public $horario_id;

    public $pagination = 10;

    public function descargarExcel(){

        $this->fecha1 = $this->fecha1 . ' 00:00:00';
        $this->fecha2 = $this->fecha2 . ' 23:59:59';

        try {

            /* return Excel::download(new FaltasExport($this->falta_empleado, $this->falta_tipo, $this->fecha1, $this->fecha2), 'Reporte_de_faltas_' . now()->format('d-m-Y') . '.xlsx'); */

        } catch (\Throwable $th) {

            Log::error("Error generar archivo de reporte de faltas por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function mount(){

        $this->empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

        $this->localidades = Constantes::LOCALIDADES;

        $this->areas = Constantes::AREAS_ADSCRIPCION;

        $this->tipos = Constantes::TIPO;

        $this->horarios = Horario::all();
    }

    public function render()
    {

        $personal = Persona::with('horario')
                                ->withWhereHas('checados', function($q){
                                    $q->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59']);
                                })
                                ->when(isset($this->status) && $this->status != "", function($q){
                                    return $q->where('status', $this->status);
                                })
                                ->when(isset($this->empleado_id) && $this->empleado_id != "", function($q){
                                    return $q->where('id', $this->empleado_id);
                                })
                                ->when(isset($this->localidad) && $this->localidad != "", function($q){
                                    return $q->where('localidad', $this->localidad);
                                })
                                ->when(isset($this->area) && $this->area != "", function($q){
                                    return $q->where('area', $this->area);
                                })
                                ->when(isset($this->tipo) && $this->tipo != "", function($q){
                                    return $q->where('tipo', $this->tipo);
                                })
                                ->when(isset($this->horario_id) && $this->horario_id != "", function($q){
                                    return $q->WhereHas('horario', function($q){
                                        $q->where('id', $this->horario_id);
                                    });
                                })
                                ->paginate($this->pagination);

        return view('livewire.reportes.reporte-checado', compact('personal'));
    }
}
