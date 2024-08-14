<?php

namespace App\Http\Controllers\Checador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChecadorController extends Controller
{

    public function __invoke(){

        return view('checador.checador');

     }

}
