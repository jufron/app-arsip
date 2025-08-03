<?php

namespace App\Services\Arsip;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface ArsipServiceInterface
{
    public function getAll () : JsonResponse;

    public function getDokumenPemohon();

    public function storeArsip(Request $request) : void;

    public function showArsip(Arsip $arsip) : JsonResponse;

    public function updateArsip(Arsip $arsip, Request $request) : void;

    public function destroyArsip(Arsip $arsip) : void;
}
