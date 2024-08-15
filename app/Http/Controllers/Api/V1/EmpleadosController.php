<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\Checador;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmpleadoResource;

class EmpleadosController extends Controller
{

    public function __invoke($area)
    {

        $checados = Checador::select('id','tipo', 'persona_id')
                                ->with('persona:id,nombre,ap_paterno,ap_materno,area')
                                ->whereHas('persona', function($q) use ($area){
                                    return $q->where('area', $area);
                                })
                                ->whereDate('created_at', Carbon::today())
                                ->get()
                                ->groupBy('persona_id');

        $empleados = [];

        foreach ($checados as $checado) {

            if($checado->last()->tipo == 'entrada')
                array_push($empleados, $checado->last()->persona);
        }

        return EmpleadoResource::collection($empleados);

    }

}
