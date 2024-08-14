<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Persona;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RevisarPermisosPersonalesActivos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'revisar:permisos_activos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa los permisos que no tienen tiempo consumido debido a que el empleado no registro su regreso';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        try {

            $empleados = Persona::with('permisos', 'checados','ultimoChecado', 'horario')->where('status', 'activo')->get();

            foreach($empleados as $empleado){

                $permiso = $empleado->permisos()->where('tipo', 'personal')
                                                ->where('tiempo_consumido', null)
                                                ->where('status', null)
                                                ->whereDate('fecha_inicio', Carbon::yesterday()->toDateString())
                                                ->first();

                if($permiso && $empleado->ultimoChecado && $empleado->ultimoChecado->tipo == 'salida'){

                    $horaSalida = Carbon::createFromTimeStamp(strtotime($this->obtenerDia($empleado->horario)));

                    $horaChecada = $empleado->ultimoChecado->created_at;

                    if($horaSalida > $horaChecada){

                        $permiso->pivot->tiempo_consumido = $horaSalida->diffInMinutes($horaChecada);
                        $permiso->pivot->save();

                    }

                }

            }

            Log::info('Proceso completo para calcular tiempo consumido por permisos sin checada de regreso.');

        } catch (\Throwable $th) {

            Log::error('Error en proceso para calcular tiempo consumido por permisos sin checada de regreso. ' . $th);

        }

    }

    public function obtenerDia($horario){

        $a =  [
            'Monday' => 'lunes_salida',
            'Tuesday' => 'martes_salida',
            'Wednesday' => 'miercoles_salida',
            'Thursday' => 'jueves_salida',
            'Friday' => 'viernes_salida'
        ][now()->format('l')];

        return $horario[$a];

    }

}
