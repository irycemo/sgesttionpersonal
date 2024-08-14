<?php

namespace App\Livewire\Incapacidad;

use Carbon\Carbon;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Incapacidad;
use Livewire\WithPagination;
use App\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Log;
use App\Services\JustificacionService;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Incapacidades extends Component
{

    use WithPagination;
    use WithFileUploads;
    use ComponentesTrait;

    public Incapacidad $modelo_editar;

    public $documento;
    public $personal;

    protected $queryString = ['search'];

    protected function rules(){
        return [
            'documento' => 'nullable|mimes:jpg,png,jpeg',
            'modelo_editar.persona_id' => 'required|numeric',
            'modelo_editar.tipo' => 'required',
            'modelo_editar.fecha_inicial' => 'required|date',
            'modelo_editar.fecha_final' => 'required|date|after_or_equal:modelo_editar.fecha_inicial',
            'modelo_editar.observaciones' => 'nullable'
         ];
    }

    protected $validationAttributes  = [
        'modelo_editar.fecha_inicial' => 'fecha inicial',
        'modelo_editar.fecha_final' => 'fecha final',
        'modelo_editar.persona_id' => 'empleado',
    ];

    protected $messages = [
        'modelo_editar.fecha_inicial.after' => 'El campo fecha inicial debe ser una fecha posterior al día de ayer.'
    ];

    public function crearModeloVacio(){
        $this->modelo_editar = Incapacidad::make();
    }

    public function abrirModalEditar(Incapacidad $modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

    }

    public function guardar(){

        $this->validate();

        $incapacidad = Incapacidad::where('persona_id', $this->modelo_editar->persona_id)
                                    ->where('fecha_inicial', '<=', $this->modelo_editar->fecha_inicial)
                                    ->where('fecha_final', '>=', $this->modelo_editar->fecha_final)
                                    ->first();

        if($incapacidad){

            $this->dispatch('mostrarMensaje', ['error', "Ya tiene una incapacidad asignada que cobre esa fecha."]);

            $this->resetearTodo();

            return;

        }

        try {

            if($this->documento){

                $nombreArchivo = $this->documento->store('/', 'incapacidades');

                $this->dispatch('removeFiles');

                $this->modelo_editar->documento = $nombreArchivo;

            }

            $this->modelo_editar->folio = (Incapacidad::max('folio') ?? 0) + 1;
            $this->modelo_editar->creado_por = auth()->user()->id;
            $this->modelo_editar->save();

            (new JustificacionService())->justificarFalta($this->modelo_editar->persona_id, $this->modelo_editar->fecha_inicial, $this->modelo_editar->fecha_final, 'Se justifica falta mediante registro de incapacidad con folio: ' . $this->modelo_editar->folio);

            (new JustificacionService())->justificarRetardo($this->modelo_editar->persona_id, $this->modelo_editar->fecha_inicial, $this->modelo_editar->fecha_final, 'Se justifica retardo mediante registro de incapacidad con folio: ' . $this->modelo_editar->folio);

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "La incapacidad se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear incapacidad por el usuario: " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }
    }

    public function actualizar(){

        $this->validate();

        try{

            if($this->documento){

                Storage::disk('incapacidades')->delete($this->modelo_editar->documento);

                $nombreArchivo = $this->documento->store('/', 'incapacidades');

                $this->dispatch('removeFiles');

                $this->modelo_editar->documento = $nombreArchivo;

            }

            $this->modelo_editar->actualizado_por = auth()->user()->id;
            $this->modelo_editar->save();

            (new JustificacionService())->justificarFalta($this->modelo_editar->persona_id, $this->modelo_editar->fecha_inicial, $this->modelo_editar->fecha_final, 'Se justifica falta mediante registro de incapacidad con folio: ' . $this->modelo_editar->folio);

            (new JustificacionService())->justificarRetardo($this->modelo_editar->persona_id, $this->modelo_editar->fecha_inicial, $this->modelo_editar->fecha_final, 'Se justifica retardo mediante registro de incapacidad con folio: ' . $this->modelo_editar->folio);

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "La incapacidad se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar incapacidad por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $incapacidad = Incapacidad::find($this->selected_id);

            if($incapacidad->documento) Storage::disk('incapacidades')->delete($incapacidad->documento);

            $incapacidad->delete();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "La incapacidad se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar incapacidad por el usuario: " . "(id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }
    }

    public function mount(){

        $this->crearModeloVacio();

        $this->personal = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')
                                    ->where('status', 'activo')
                                    ->when(!auth()->user()->hasRole('Administrador'), function($q){
                                        $q->where('localidad', auth()->user()->localidad);
                                    })
                                    ->orderBy('nombre')->get();

    }

    public function render()
    {

        $incapacidades = Incapacidad::with('persona:id,nombre,ap_paterno,ap_materno', 'creadoPor:id,name', 'actualizadoPor:id,name')
                                        ->where('folio', 'LIKE', '%' . $this->search . '%')
                                        ->orWhere('documento', 'LIKE', '%' . $this->search . '%')
                                        ->orWhere('tipo', 'LIKE', '%' . $this->search . '%')
                                        ->orWhere('created_at','like', '%'.$this->search.'%')
                                        ->orWhereHas('persona', function($q){
                                            $q->where('nombre', 'like', '%'.$this->search.'%')
                                                ->orWhere('ap_paterno', 'like', '%'.$this->search.'%')
                                                ->orWhere('ap_materno', 'like', '%'.$this->search.'%');
                                        })
                                        ->orderBy($this->sort, $this->direction)
                                        ->paginate($this->pagination);

        return view('livewire.incapacidad.incapacidades', compact('incapacidades'))->extends('layouts.admin');
    }
}
