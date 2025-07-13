<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PetugasRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Petugas\PetugasServiceInterface;

class PetugasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  PetugasServiceInterface  $petugasService
     */
    public function __construct(
        protected PetugasServiceInterface $petugasService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('dashboard.petugas.petugas', [
            'user' => User::where('id', '!=', auth()->id())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('dashboard.petugas.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PetugasRequest $request) : RedirectResponse
    {
        $this->petugasService->storePetugas($request);
        notify()->success('Berhasil Menambahkan Anggota Baru');
        return redirect()->route('dashboard.petugas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) : JsonResponse
    {
        return $this->petugasService->showPetugas($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) : RedirectResponse
    {
        $this->petugasService->destroyPetugas($user);
        notify()->success('Berhasil Menghapus Petugas');
        return redirect()->route('dashboard.petugas.index');
    }
}
