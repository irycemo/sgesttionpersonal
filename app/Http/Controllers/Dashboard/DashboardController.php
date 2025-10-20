<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __invoke():View
    {
        return view('dashboard.dashboard');
    }

}
