<?php

namespace App\Services\Pemohon;

use App\Models\Pemohon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface PemohonServiceInterface
{
    public function getAll () : JsonResponse;

    public function storePemohon(Request $request) : void;

    public function showPemohon(Pemohon $pemohon) : JsonResponse;

    public function updatePemohon(Pemohon $pemohon, Request $request) : void;

    public function destroyPemohon(Pemohon $pemohon) : void;
}
