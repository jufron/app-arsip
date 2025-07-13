<?php

namespace App\Services\Petugas;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface PetugasServiceInterface
{
    public function storePetugas(Request $request) : void;

    public function showPetugas(User $user) : JsonResponse;

    public function destroyPetugas(User $user) : void;
}
