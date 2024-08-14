<?php

namespace App\Livewire\Reportes;

use App\Models\Persona;
use App\Models\Retardo;
use Livewire\Component;
use Livewire\WithPagination;
use App\Constantes\Constantes;
use App\Exports\RetardosExport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReporteRetardo extends Component
{

    use WithPagination;

    public $area;
    public $areas;
    public $localidades;
    public $localidad;
    public $empleados;
    public $retardo_empleado;
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

            return Excel::download(new RetardosExport($this->localidad, $this->area, $this->retardo_empleado, $this->fecha1, $this->fecha2), 'Reporte_de_retardos_' . now()->format('d-m-Y') . '.xlsx');

        } catch (\Throwable $th) {

            Log::error("Error generar archivo de reporte de retardos por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function mount(){

        $this->areas = collect(Constantes::AREAS_ADSCRIPCION)->sort();

        $this->localidades = Constantes::LOCALIDADES;

        $this->empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

    }

    public function render()
    {

        $retardos = Retardo::with('persona', 'justificacion')
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
                                ->when(isset($this->retardo_empleado) && $this->retardo_empleado != "", function($q){
                                    return $q->where('persona_id', $this->retardo_empleado);
                                })
                                ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                                ->paginate($this->pagination);

        return view('livewire.reportes.reporte-retardo', compact('retardos'));
    }
}
