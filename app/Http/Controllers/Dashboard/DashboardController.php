<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard index view.
     *
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        return view('dashboard.index');
    }
}
