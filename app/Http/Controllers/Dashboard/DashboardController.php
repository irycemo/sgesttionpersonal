<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Persona;
use App\Models\Checador;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __invoke():View
    {
        return view('dashboard.dashboard');
    }

}
