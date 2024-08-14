<?php

namespace App\Livewire\Admin;

use App\Models\Permiso;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Log;

class Permisos extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public Permiso $modelo_editar;

    public $unidad;

    protected $queryString = ['search'];

    protected function rules(){
        return [
            'modelo_editar.descripcion' => 'required',
            'modelo_editar.limite' => 'required|numeric',
            'modelo_editar.tipo' => 'required|string|in:personal,oficial',
            'modelo_editar.tiempo' => 'required|numeric'
         ];
    }

    protected $validationAttributes  = [
        'modelo_editar.descripcion' => 'descripción',
    ];

    public function crearModeloVacio(){
        $this->modelo_editar = Permiso::make();
    }

    public function abrirModalEditar(Permiso $modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

    }

    public function guardar(){

        $this->validate();

        if($this->modelo_editar->tipo == 'personal' && $this->unidad == 'dias'||
            $this->modelo_editar->tipo == 'personal' && $this->modelo_editar->tiempo >= 24){

            $this->dispatch('mostrarMensaje', ['error', "Los permisos personales no pueden ser mayores a 24 hrs."]);

            return;

        }

        $this->convertirTiempo();

        try {

            $this->modelo_editar->creado_por = auth()->user()->id;

            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El permiso se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear permiso por el usuario: " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }
    }

    public function actualizar(){

        $this->validate();

        if($this->modelo_editar->tipo == 'personal' && $this->unidad == 'dias'||
            $this->modelo_editar->tipo == 'personal' && $this->modelo_editar->tiempo >= 24){

            $this->dispatch('mostrarMensaje', ['error', "Los permisos personales no pueden ser mayores a 24 hrs."]);

            return;

        }

        $this->convertirTiempo();

        try{

            $this->modelo_editar->actualizado_por = auth()->user()->id;
            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El permiso se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar permiso por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $permiso = Permiso::find($this->selected_id);

            $permiso->delete();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El permiso se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar permiso por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }
    }

    public function convertirTiempo(){

        if($this->unidad == 'dias'){
            $this->modelo_editar->tiempo = (int)$this->modelo_editar->tiempo * 24;
        }

    }

    public function render()
    {

        $permisos = Permiso::with('creadoPor', 'actualizadoPor')
                            ->where('descripcion','like', '%'.$this->search.'%')
                            ->orWhere('tipo','like', '%'.$this->search.'%')
                            ->orWhere('created_at','like', '%'.$this->search.'%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        return view('livewire.admin.permisos', compact('permisos'))->extends('layouts.admin');
    }
}
