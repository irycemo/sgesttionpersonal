<?php

namespace App\Livewire\Personal;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Checador;

class FullCalendar extends Component
{

    public $persona_id;
    public $mes;
    public $events;

    public function updatedMes(){

        if($this->mes == "")
            return;

        $events = Checador::where('persona_id', $this->persona_id)->whereMonth('created_at', Carbon::createFromFormat('Y-m-d', $this->mes . '-01'))->get();

        $this->changeEvents($events);

        $this->dispatch('refreshCalendar');

    }

    public function changeEvents($events){

        $events = $events->map(function($event){

            return collect([
                'title' => ucfirst($event->tipo) . ' ' . $event->created_at->format('H:i:s'),
                'start' => $event->created_at->format('Y-m-d')
            ]);

        });

        $this->events = json_encode($events);

    }

    public function mount(){

        $events = Checador::where('persona_id', $this->persona_id)->get();

        $this->changeEvents($events);

    }

    public function render()
    {
        return view('livewire.personal.full-calendar');
    }

}
