<?php

namespace App\Http\Controllers\Persona;

use App\Models\Persona;
use App\Http\Controllers\Controller;

class PersonaController extends Controller
{

    public function __invoke(Persona $persona)
    {

        return view('persona.show', compact('persona'));

    }

}
