<?php

namespace App\Livewire\Reportes;

use App\Models\Falta;
use App\Models\Persona;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\FaltasExport;
use App\Constantes\Constantes;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReporteFlata extends Component
{

    use WithPagination;

    public $area;
    public $areas;
    public $localidades;
    public $localidad;
    public $empleados;
    public $empleado_id;
    public $falta_tipo;
    public $fecha1;
    public $fecha2;

    public $pagination = 10;

    public function updatedArea(){

        if($this->area === ""){

            $this->empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

        }else{

            $this->empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->where('area', $this->area)->orderBy('nombre')->get();

        }

    }

    public function descargarExcel(){

        $this->fecha1 = $this->fecha1 . ' 00:00:00';
        $this->fecha2 = $this->fecha2 . ' 23:59:59';

        try {

            return Excel::download(new FaltasExport($this->localidad, $this->area, $this->empleado_id, $this->falta_tipo, $this->fecha1, $this->fecha2), 'Reporte_de_faltas_' . now()->format('d-m-Y') . '.xlsx');

        } catch (\Throwable $th) {

            Log::error("Error generar archivo de reporte de faltas por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function mount(){

        $this->areas = Constantes::AREAS_ADSCRIPCION;

        $this->localidades = Constantes::LOCALIDADES;

        $this->empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

    }

    public function render()
    {

        $faltas = Falta::with('persona', 'justificacion')
                            ->when (isset($this->localidad) && $this->localidad != "", function($q){
                                return $q->whereHas('persona', function($q){
                                    $q->where('localidad', $this->localidad);
                                });
                            })
                            ->when (isset($this->area) && $this->area != "", function($q){
                                return $q->whereHas('persona', function($q){
                                    $q->where('area', $this->area);
                                });
                            })
                            ->when(isset($this->empleado_id) && $this->empleado_id != "", function($q){
                                return $q->where('persona_id', $this->empleado_id);
                            })
                            ->when(isset($this->falta_tipo) && $this->falta_tipo != "", function($q){
                                return $q->where('tipo', 'like','%'.$this->falta_tipo.'%');
                            })
                            ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                            ->paginate($this->pagination);

        return view('livewire.reportes.reporte-flata',compact('faltas'));
    }
}
