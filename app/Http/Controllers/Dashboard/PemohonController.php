<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Pemohon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PemohonRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Services\Pemohon\PemohonServiceInterface;

class PemohonController extends Controller
{
    /**
     * Jenis pengurusan yang tersedia.
     *
     * @var array
     */
    protected array $jenisPengurusan = [
        'KTP baru',
        'Rusak',
        'Hilang',
        'Lainya'
    ];

    /**
     * Create a new controller instance.
     *
     * @param PemohonServiceInterface $pemohonService
     */
    public function __construct(
        protected PemohonServiceInterface $pemohonService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('dashboard.pemohon.pemohon', [
            'jenis_pengurusan'  => $this->jenisPengurusan,
        ]);
    }

    /**
     * Fetch the latest pemohon data.
     */
    public function getLatest() : JsonResponse
    {
        return $this->pemohonService->getAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pemohon.tambah', [
            'jenis_pengurusan' => $this->jenisPengurusan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemohonRequest $request) : RedirectResponse
    {
        $this->pemohonService->storePemohon($request);
        notify()->success('Data pemohon berhasil ditambahkan', 'Sukses');
        return redirect()->route('dashboard.pemohon.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemohon $pemohon) : JsonResponse
    {
        return $this->pemohonService->showPemohon($pemohon);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemohon $pemohon)
    {
        return view('dashboard.pemohon.ubah', [
            'pemohon' => $pemohon,
            'jenis_pengurusan' => $this->jenisPengurusan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemohonRequest $request, Pemohon $pemohon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemohon $pemohon) : RedirectResponse
    {
        $this->pemohonService->destroyPemohon($pemohon);
        notify()->success('Data pemohon berhasil dihapus', 'Sukses');
        return redirect()->route('dashboard.pemohon.index');
    }
}
