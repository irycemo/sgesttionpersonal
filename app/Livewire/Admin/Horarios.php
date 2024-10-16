<?php

namespace App\Livewire\Admin;

use App\Models\Horario;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Log;

class Horarios extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public Horario $modelo_editar;

    protected $queryString = ['search'];

    protected function rules(){
        return [
            'modelo_editar.descripcion' => 'required',
            'modelo_editar.nombre' => 'required',
            'modelo_editar.lunes_entrada' => 'required',
            'modelo_editar.lunes_salida' => 'required|after:modelo_editar.lunes_entrada',
            'modelo_editar.martes_entrada' => 'required',
            'modelo_editar.martes_salida' => 'required|after:modelo_editar.martes_entrada',
            'modelo_editar.miercoles_entrada' => 'required',
            'modelo_editar.miercoles_salida' => 'required|after:modelo_editar.miercoles_entrada',
            'modelo_editar.jueves_entrada' => 'required',
            'modelo_editar.jueves_salida' => 'required|after:modelo_editar.jueves_entrada',
            'modelo_editar.viernes_entrada' => 'required',
            'modelo_editar.viernes_salida' => 'required|after:modelo_editar.viernes_entrada',
            'modelo_editar.tolerancia' => 'required|numeric',
            'modelo_editar.falta' => 'required|gt:modelo_editar.tolerancia'
         ];
    }

    protected $validationAttributes  = [
        'modelo_editar.descripcion' => 'descripción',
        'modelo_editar.lunes_entrada' => 'entrada',
        'modelo_editar.lunes_salida' => 'salida',
        'modelo_editar.martes_entrada' => 'entrada',
        'modelo_editar.martes_salida' => 'salida',
        'modelo_editar.miercoles_entrada' => 'entrada',
        'modelo_editar.miercoles_salida' => 'salida',
        'modelo_editar.jueves_entrada' => 'entrada',
        'modelo_editar.jueves_salida' => 'salida',
        'modelo_editar.viernes_entrada' => 'entrada',
        'modelo_editar.viernes_salida' => 'salida',
    ];

    public function crearModeloVacio(){
        $this->modelo_editar = Horario::make();
    }

    public function abrirModalEditar(Horario $modelo){

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

            $this->dispatch('mostrarMensaje', ['success', "El horario se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear horario por el usuario: " . auth()->user()->name . ". " . $th);

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

            $this->dispatch('mostrarMensaje', ['success', "El horario se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar horario por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $horario = Horario::find($this->selected_id);

            $horario->delete();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El horario se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar horario por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }
    }

    public function render()
    {

        $horarios = Horario::with('creadoPor', 'actualizadoPor')
                                ->where('descripcion', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('nombre', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('descripcion', 'LIKE', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);

       return view('livewire.admin.horarios', compact('horarios'))->extends('layouts.admin');
    }

}
