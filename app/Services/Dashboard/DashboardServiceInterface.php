<?php

namespace App\Services\Dashboard;

use Illuminate\Http\JsonResponse;

interface DashboardServiceInterface
{
    public function getAllStatistic () : JsonResponse;
}
