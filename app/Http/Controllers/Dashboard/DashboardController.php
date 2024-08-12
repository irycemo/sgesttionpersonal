<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function __invoke():View
    {

        return view('dashboard');

        /* $faltas = Falta::whereMonth('created_at', Carbon::now()->month)->count();

        $permisos = DB::table('permisos_persona')->whereMonth('created_at', Carbon::now()->month)->count();

        $retardos = Retardo::whereMonth('created_at', Carbon::now()->month)->count();

        $justificaciones = Justificacion::whereMonth('created_at', Carbon::now()->month)->count();

        $incapacidades = Incapacidad::whereMonth('created_at', Carbon::now()->month)->count();

        $personalCatastroTotal = Persona::where('status', 'activo')->where('localidad', 'Catastro')->count();

        $personalRPPTotal = Persona::where('status', 'activo')->where('localidad', 'RPP')->count();

        $personalRegional1Total = Persona::where('status', 'activo')->where('localidad', 'Regional 1')->count();

        $personalRegional2Total = Persona::where('status', 'activo')->where('localidad', 'Regional 2')->count();

        $personalRegional3Total = Persona::where('status', 'activo')->where('localidad', 'Regional 3')->count();

        $personalRegional4Total = Persona::where('status', 'activo')->where('localidad', 'Regional 4')->count();

        $personalRegional5Total = Persona::where('status', 'activo')->where('localidad', 'Regional 5')->count();

        $personalRegional6Total = Persona::where('status', 'activo')->where('localidad', 'Regional 6')->count();

        $personalRegional7Total = Persona::where('status', 'activo')->where('localidad', 'Regional 7')->count();

        $checados = Checador::with('persona')->whereDay('created_at', Carbon::today())->get()->groupBy('persona');

        $personalCatastroPresente = 0;

        $personalRppPresente = 0;

        $personalRegional1Presente = 0;

        $personalRegional2Presente = 0;

        $personalRegional3Presente = 0;

        $personalRegional4Presente = 0;

        $personalRegional5Presente = 0;

        $personalRegional6Presente = 0;

        $personalRegional7Presente = 0;

        foreach($checados as $checado){

            if($checado->last()->persona->localidad == 'Catastro' && $checado->last()->tipo == 'entrada')
                $personalCatastroPresente ++;

            if($checado->last()->persona->localidad == 'RPP' && $checado->last()->tipo == 'entrada')
                $personalRppPresente ++;

            if($checado->last()->persona->localidad == 'Regional 1' && $checado->last()->tipo == 'entrada')
                $personalRegional1Presente ++;

            if($checado->last()->persona->localidad == 'Regional 2' && $checado->last()->tipo == 'entrada')
                $personalRegional2Presente ++;

            if($checado->last()->persona->localidad == 'Regional 3' && $checado->last()->tipo == 'entrada')
                $personalRegional3Presente ++;

            if($checado->last()->persona->localidad == 'Regional 4' && $checado->last()->tipo == 'entrada')
                $personalRegional4Presente ++;

            if($checado->last()->persona->localidad == 'Regional 5' && $checado->last()->tipo == 'entrada')
                $personalRegional5Presente ++;

            if($checado->last()->persona->localidad == 'Regional 6' && $checado->last()->tipo == 'entrada')
                $personalRegional6Presente ++;

            if($checado->last()->persona->localidad == 'Regional 7' && $checado->last()->tipo == 'entrada')
                $personalRegional7Presente ++;

        }

        return view('dashboard', compact(
                                            'faltas',
                                            'permisos',
                                            'retardos',
                                            'justificaciones',
                                            'incapacidades',
                                            'personalCatastroTotal',
                                            'personalRPPTotal',
                                            'personalRegional1Total',
                                            'personalRegional2Total',
                                            'personalRegional3Total',
                                            'personalRegional4Total',
                                            'personalRegional5Total',
                                            'personalRegional6Total',
                                            'personalRegional7Total',
                                            'personalCatastroPresente',
                                            'personalRppPresente',
                                            'personalRegional1Presente',
                                            'personalRegional2Presente',
                                            'personalRegional3Presente',
                                            'personalRegional4Presente',
                                            'personalRegional5Presente',
                                            'personalRegional6Presente',
                                            'personalRegional7Presente',
                                        )
                    );

                    */
    }

}
