<?php

namespace App\Livewire\Personal;

use Livewire\Component;
use App\Models\Incapacidad;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Incapacidades extends Component
{

    use WithPagination;

    public $persona;
    public $pagination = 10;

    public $selected_id;
    public $modal = false;

    public function abrirModalEliminar($id){

        $this->selected_id = $id;

        $this->modal = true;

    }

    public function eliminar(){

        try {

            $incapacidad = Incapacidad::find($this->selected_id);

            if($incapacidad->documento) Storage::disk('incapacidades')->delete($incapacidad->documento);

            $incapacidad->delete();

            $this->dispatch('mostrarMensaje', ['success', "La incapacidad se eliminó con éxito."]);

            $this->modal = false;


        } catch (\Throwable $th) {

            Log::error("Error al borrar incapacidad asignada por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

            $this->modal = false;

        }

    }

    public function render()
    {

        $incapacidades = Incapacidad::with('creadoPor', 'actualizadoPor')
                                    ->where('persona_id', $this->persona->id)
                                    ->latest()
                                    ->paginate($this->pagination);

        return view('livewire.personal.incapacidades', compact('incapacidades'));
    }
}
