<?php

namespace App\Livewire\Reportes;

use App\Models\Persona;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Justificacion;
use App\Constantes\Constantes;
use Illuminate\Support\Facades\Log;
use App\Exports\JustificacionExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteJustificacion extends Component
{

    use WithPagination;

    public $area;
    public $areas;
    public $empleados;
    public $justificaciones_folio;
    public $empleado_id;
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

            return Excel::download(new JustificacionExport($this->area, $this->justificaciones_folio, $this->empleado_id, $this->fecha1, $this->fecha2), 'Reporte_de_justificaciones_' . now()->format('d-m-Y') . '.xlsx');

        } catch (\Throwable $th) {

            Log::error("Error generar archivo de reporte de incapacidades por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
        }

    }

    public function mount(){

        $this->areas = Constantes::AREAS_ADSCRIPCION;

        $this->empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

    }

    public function render()
    {

        $justificaciones = Justificacion::with('creadoPor', 'actualizadoPor','persona', 'falta', 'retardo')
                                            ->when (isset($this->area) && $this->area != "", function($q){
                                                return $q->whereHas('persona', function($q){
                                                    $q->where('area', $this->area);
                                                });
                                            })
                                            ->when(isset($this->empleado_id) && $this->empleado_id != "", function($q){
                                                return $q->where('persona_id', $this->empleado_id);
                                            })
                                            ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                                            ->paginate($this->pagination);

        return view('livewire.reportes.reporte-justificacion', compact('justificaciones'));
    }
}
