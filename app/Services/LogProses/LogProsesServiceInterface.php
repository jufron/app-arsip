<?php

namespace App\Services\LogProses;

use App\Models\LogProses;
use Illuminate\Http\JsonResponse;

interface LogProsesServiceInterface
{
    public function getAll () : JsonResponse;

    public function showLogProses (LogProses $logProses) : JsonResponse;
}
