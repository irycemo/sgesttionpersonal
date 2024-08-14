<?php

namespace App\Livewire\Inabil;

use App\Models\Inhabil;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Log;

class Inabiles extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public Inhabil $modelo_editar;

    public $unidad;

    protected $queryString = ['search'];

    protected function rules(){
        return [
            'modelo_editar.fecha' => 'required',
            'modelo_editar.descripcion' => 'required'
         ];
    }

    protected $validationAttributes  = [
        'modelo_editar.descripcion' => 'descripción',
    ];

    public function crearModeloVacio(){
        $this->modelo_editar = Inhabil::make();
    }

    public function abrirModalEditar(Inhabil $modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

    }

    public function guardar(){

        $this->validate();

        try {

            $this->modelo_editar->creado_por = auth()->user()->id;

            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El día inhabil se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear  día inhabil por el usuario: " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }
    }

    public function actualizar(){

        $this->validate();

        try{

            $this->modelo_editar->actualizado_por = auth()->user()->id;
            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El  día inhabil se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar  día inhabil por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $dia = Inhabil::find($this->selected_id);

            $dia->delete();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El día inhabil se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar día inhabil por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }
    }

    public function render()
    {

        $inhabiles = Inhabil::with('creadoPor', 'actualizadoPor')
                            ->where('descripcion', 'LIKE', '%' . $this->search . '%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        return view('livewire.inabil.inabiles', compact('inhabiles'))->extends('layouts.admin');
    }
}
