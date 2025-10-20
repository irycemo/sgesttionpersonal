<?php

namespace App\Livewire\Justificacion;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Persona;
use App\Models\Retardo;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Justificacion;
use Livewire\WithFileUploads;
use App\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Justificaciones extends Component
{

    use WithPagination;
    use WithFileUploads;
    use ComponentesTrait;

    public Justificacion $modelo_editar;

    public $documento;
    public $personal;
    public $retardos;
    public $faltas;
    public $retardo_id;
    public $falta_id;
    public $persona_id;

    public $retardoFlag = true;
    public $faltaFlag = true;

    protected $queryString = ['search'];

    protected function rules(){
        return [
            'documento' => 'nullable|mimes:jpg,png,jpeg',
            'persona_id' => 'required|numeric',
            'modelo_editar.observaciones' => 'nullable',
            'retardo_id' => 'required_without:falta_id',
            'falta_id' => 'required_without:retardo_id',
         ];
    }

    protected $validationAttributes  = [
        'modelo_editar.persona_id' => 'empleado',
        'retardo_id.required_without' => 'El campo retardo es obligatorio cuando falta no está presente',
        'falta_id.required_without' => 'El campo falta es obligatorio cuando retardo no está presente',
    ];

    public function crearModeloVacio(){
        $this->modelo_editar = Justificacion::make();
    }

    public function updatedPersonaId(){

        $this->reset('falta_id', 'retardo_id');

        $this->faltas = Falta::where('persona_id', $this->persona_id)->where('justificacion_id', null)->get();

        $this->retardos = Retardo::where('persona_id', $this->persona_id)->where('justificacion_id', null)->get();

        $this->retardoFlag = true;

        $this->faltaFlag = true;

    }

    public function updatedRetardoId(){

        $this->faltaFlag = false;

        $this->reset('falta_id');

    }

    public function updatedFaltaId(){

        $this->retardoFlag = false;

        $this->reset('retardo_id');

    }

    public function abrirModalEditar(Justificacion $modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

        $this->persona_id = $this->modelo_editar->persona_id;

        $this->updatedPersonaId();

        if($this->modelo_editar->falta){

            $this->falta_id = $this->modelo_editar->falta->id;

        }

        if($this->modelo_editar->retardo){

            $this->retardo_id = $this->modelo_editar->retardo->id;

        }


    }

    public function guardar(){

        $this->validate();

        try {

            if($this->documento){

                $nombreArchivo = $this->documento->store('/', 'justificacion');

                $this->dispatch('removeFiles');

                $this->modelo_editar->documento = $nombreArchivo;

            }

            $this->modelo_editar->folio = (Justificacion::max('folio') ?? 0) + 1;
            $this->modelo_editar->persona_id = $this->persona_id;
            $this->modelo_editar->creado_por = auth()->user()->id;
            $this->modelo_editar->save();

            if($this->falta_id){

                $falta = Falta::find($this->falta_id);
                $falta->update(['justificacion_id' => $this->modelo_editar->id]);

                $this->justificacionTresRetardos($falta);

            }

            if($this->retardo_id){

                $retardo = Retardo::find($this->retardo_id);
                $retardo->update(['justificacion_id' => $this->modelo_editar->id]);

            }

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "La justificación se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear justificación por el usuario: " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }
    }

    public function actualizar(){

        $this->validate();

        try{

            if($this->documento){

                if($this->modelo_editar->documento){

                    Storage::disk('justificacion')->delete($this->modelo_editar->documento);

                }

                $nombreArchivo = $this->documento->store('/', 'justificacion');

                $this->dispatch('removeFiles');

                $this->modelo_editar->documento = $nombreArchivo;

            }

            $this->modelo_editar->actualizado_por = auth()->user()->id;
            $this->modelo_editar->save();

            if($this->modelo_editar->falta)
                $this->modelo_editar->falta->update(['justificacion_id' => null]);

            if($this->modelo_editar->retardo)
                $this->modelo_editar->retardo->update(['justificacion_id' => null]);

            if($this->falta_id){

                $falta = Falta::find($this->falta_id);

                $falta->update(['justificacion_id' => $this->modelo_editar->id]);

            }

            if($this->retardo_id){

                $retardo = Retardo::find($this->retardo_id);

                $retardo->update(['justificacion_id' => $this->modelo_editar->id]);

            }

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "La justificación se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar justificación por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $justificación = Justificacion::find($this->selected_id);

            if($justificación->retardo)
                $justificación->retardo->update(['justificacion_id' => null]);

            if($justificación->falta)
                $justificación->falta->update(['justificacion_id' => null]);

            if($justificación->documento) Storage::disk('justificacion')->delete($justificación->documento);

            $justificación->delete();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "La justificación se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar justificación por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }
    }

    public function justificacionTresRetardos($falta){

        if($falta->tipo === 'Falta por acomulación de 3 retardos en el mes actual.'){

            $retardos = Retardo::where('status',  0)
                            ->where('persona_id', $this->persona_id)
                            ->whereNull('justificacion_id')
                            ->whereMonth('created_at', Carbon::now()->month)
                            ->latest()
                            ->take(2)
                            ->get();

            foreach ($retardos as $retardo) {

                $retardo->status = 1;
                $retardo->save();

            }

        }

    }

    public function mount(){

        $this->crearModeloVacio();

        array_push($this->fields, 'documento', 'retardo_id', 'falta_id', 'persona_id', 'retardoFlag', 'faltaFlag');

        $this->personal = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')
                                    ->where('status', 'activo')
                                    ->when(!auth()->user()->hasRole(['Administrador', 'Contador(a)', 'Delegado(a) Administrativo(a)']), function($q){
                                        $q->where('localidad', auth()->user()->localidad);
                                    })
                                    ->orderBy('nombre')->get();

    }
    public function render()
    {

        $justificaciones = Justificacion::with('falta', 'retardo', 'persona', 'creadoPor', 'actualizadoPor')
                                        ->where('folio', 'LIKE', '%' . $this->search . '%')
                                        ->orWhereHas('persona', function($q){
                                            $q->where('nombre', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere('ap_paterno', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere('ap_materno', 'LIKE', '%' . $this->search . '%');
                                        })
                                        ->orderBy($this->sort, $this->direction)
                                        ->paginate($this->pagination);

        return view('livewire.justificacion.justificaciones', compact('justificaciones'))->extends('layouts.admin');
    }
}
