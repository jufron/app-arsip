<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Pemohon;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display the dashboard index view.
     *
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        return view('dashboard.index', [
            'petugas_count' => User::count(),
            'pemohon_count' => Pemohon::count(),
        ]);
    }
}
