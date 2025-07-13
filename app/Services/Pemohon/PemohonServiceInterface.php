<?php

namespace App\Services\Pemohon;

use Illuminate\Http\Request;

interface PemohonServiceInterface
{
    public function storePemohon(Request $request) : void;
}
