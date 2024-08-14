<?php

namespace App\Livewire\Personal;

use App\Models\Retardo;
use Livewire\Component;
use Livewire\WithPagination;

class Retardos extends Component
{

    use WithPagination;

    public $persona;
    public $pagination;

    public function render()
    {

        $retardos = Retardo::with('justificacion')
                                    ->where('persona_id', $this->persona->id)
                                    ->latest()
                                    ->paginate($this->pagination);

        return view('livewire.personal.retardos', compact('retardos'));

    }
}
