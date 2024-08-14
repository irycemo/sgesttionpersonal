<?php

namespace App\Livewire\Reportes;

use App\Models\Horario;
use App\Models\Persona;
use Livewire\Component;
use Livewire\WithPagination;
use App\Constantes\Constantes;
use App\Exports\PersonalExport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportePersonal extends Component
{

    use WithPagination;

    public $status;
    public $localidad;
    public $area;
    public $tipo;
    public $horario_id;
    public $fecha1;
    public $fecha2;
    public $localidades;
    public $areas;
    public $horarios;
    public $tipos;

    public $pagination = 10;

    public function descargarExcel(){

        $this->fecha1 = $this->fecha1 . ' 00:00:00';
        $this->fecha2 = $this->fecha2 . ' 23:59:59';

        try {

            return Excel::download(new PersonalExport($this->status, $this->localidad, $this->area, $this->tipo, $this->horario_id, $this->fecha1, $this->fecha2), 'Reporte_de_personal_' . now()->format('d-m-Y') . '.xlsx');

        } catch (\Throwable $th) {

            Log::error("Error generar archivo de reporte de personal por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function mount(){

        $this->localidades = Constantes::LOCALIDADES;

        $this->areas = collect(Constantes::AREAS_ADSCRIPCION)->sort();

        $this->horarios = Horario::select('id', 'nombre')->orderBy('nombre')->get();

        $this->tipos = collect(Constantes::TIPO)->sort();

    }

    public function render()
    {

        $personal = Persona::with('creadoPor', 'actualizadoPor','horario')
                                ->when(isset($this->status) && $this->status != "", function($q){
                                    return $q->where('status', $this->status);

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
                                    return $q->where('horario_id', $this->horario_id);
                                })
                                ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                                ->paginate($this->pagination);

        return view('livewire.reportes.reporte-personal', compact('personal'));

    }
}
