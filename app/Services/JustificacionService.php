<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Retardo;
use App\Models\Justificacion;

class JustificacionService{

    public function justificar(int $personaId, string $fechaInicial, string $fechaFinal, string $observaciones):void
    {

        $this->justificarFalta($personaId, $fechaInicial, $fechaFinal, $observaciones);

        $this->justificarRetardo($personaId, $fechaInicial, $fechaFinal, $observaciones);

    }

    public function justificarFalta(int $personaId, string $fechaInicial, string $fechaFinal, string $observaciones):void
    {

        $faltas = Falta::where('persona_id', $personaId)
                            ->whereNull('justificacion_id')
                            ->whereBetween('created_at', [Carbon::parse($fechaInicial)->startOfDay(), Carbon::parse($fechaFinal)->endOfDay()])
                            ->get();

        foreach ($faltas as $falta) {

            $falta->update([
                'justificacion_id' => $this->crearJustificacion($personaId, $observaciones)
            ]);

        }

    }

    public function justificarRetardo(int $personaId, string $fechaInicial, string $fechaFinal, string $observaciones):void
    {

        $retardos = Retardo::where('persona_id', $personaId)
                            ->whereNull('justificacion_id')
                            ->whereBetween('created_at', [Carbon::parse($fechaInicial)->startOfDay(), Carbon::parse($fechaFinal)->endOfDay()])
                            ->get();

        foreach ($retardos as $retardo) {

            $retardo->update([
                'justificacion_id' => $this->crearJustificacion($personaId, $observaciones)
            ]);

        }

    }

    public function crearJustificacion(int $personaId, string $observaciones):int
    {

        return Justificacion::create([
                    'folio' => (Justificacion::max('folio') ?? 0) + 1,
                    'persona_id' => $personaId,
                    'observaciones' => $observaciones,
                    'creado_por' => auth()->id()
                ])->id;

    }

}
