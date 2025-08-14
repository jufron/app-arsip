<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Pemohon;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Arsip;
use App\Services\Dashboard\DashboardServiceInterface;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardServiceInterface $dashboardService,
    ) {}

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
            'arsip_count'   => Arsip::count()
        ]);
    }

    public function statisticCount () : JsonResponse
    {
        return $this->dashboardService->getAllStatistic();
    }
}
