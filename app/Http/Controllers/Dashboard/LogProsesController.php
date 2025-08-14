<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\View\View;
use App\Models\LogProses;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\LogProses\LogProsesServiceInterface;

class LogProsesController extends Controller
{
    public function __construct(
        protected LogProsesServiceInterface $logProsesService
    ) {}

    public function index () : View
    {
        return view('dashboard.log-proses.log-proses');
    }

    public function getLatest () : JsonResponse
    {
        return $this->logProsesService->getAll();
    }

    public function show (LogProses $logProses) : JsonResponse
    {
        return $this->logProsesService->showLogProses($logProses);
    }
}
