<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Console\Scheduling\Schedule as SC;

Schedule::command('revisar:asistencias')->dailyAt('1:00')->days([SC::TUESDAY, SC::WEDNESDAY, SC::THURSDAY, SC::FRIDAY, SC::SATURDAY]);
Schedule::command('revisar:permisos_activos')->dailyAt('1:00')->days([SC::TUESDAY, SC::WEDNESDAY, SC::THURSDAY, SC::FRIDAY, SC::SATURDAY]);
Schedule::command('calcular:tiempo_permisos')->lastDayOfMonth('23:00');
Schedule::command('revisar:incidencias')->dailyAt('23:00');
Schedule::command('revisar:salida')->dailyAt('23:10');
