<?php

namespace App\Http\Controllers\Manual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManualController extends Controller
{

    public function __invoke()
    {
        return view('manual');
    }

}
