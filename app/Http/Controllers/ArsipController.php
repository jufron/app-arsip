<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ArsipRequest;
use App\Models\Pemohon;
use Illuminate\Http\RedirectResponse;
use App\Services\Arsip\ArsipServiceInterface;
use App\Services\Pemohon\PemohonService;
use App\Services\Pemohon\PemohonServiceInterface;

class ArsipController extends Controller
{
    private array $number = [
        1,2,3,4,5,6,7,8,9,10,
    ];

    public function __construct(
        protected ArsipServiceInterface $arsipService,
        protected PemohonServiceInterface $pemohonService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.arsip.arsip', [
            'number' => $this->number,
        ]);
    }

    public function getLatest() : JsonResponse
    {
        return $this->arsipService->getAll();
    }

    public function getPemohon(Pemohon $pemohon) : JsonResponse
    {
        return $this->pemohonService->showPemohon($pemohon);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.arsip.tambah', [
            'number'            => $this->number,
            'dokumen_pemohon'   => $this->arsipService->getDokumenPemohon(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArsipRequest $request) : RedirectResponse
    {
        $this->arsipService->storeArsip($request);
        return redirect()->route('dashboard.arsip.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Arsip $arsip) : JsonResponse
    {
        return $this->arsipService->showArsip($arsip);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Arsip $arsip)
    {
        return view('dashboard.arsip.ubah', [
            'arsip' => $arsip,
            'number' => $this->number,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArsipRequest $request, Arsip $arsip) : RedirectResponse
    {
        $this->arsipService->updateArsip($arsip, $request);
        notify()->success('Data arsip berhasil diubah', 'Sukses');
        return redirect()->route('dashboard.arsip.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Arsip $arsip) : RedirectResponse
    {
        $this->arsipService->destroyArsip($arsip);
        notify()->success('Data arsip berhasil dihapus', 'Sukses');
        return redirect()->route('dashboard.arsip.index');
    }
}
