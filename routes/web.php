<?php

use App\Models\FileArsip;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frond\FrondPagesController;
use App\Http\Controllers\Dashboard\PemohonController;
use App\Http\Controllers\Dashboard\PetugasController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LogProsesController;

Route::get('/', [FrondPagesController::class, 'index'])->name('welcome');

require __DIR__.'/auth.php';

Route::middleware('auth')->prefix('dashboard')->group( function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/count', [DashboardController::class, 'statisticCount'])->name('dashboard.statistick');

    Route::resource('petugas', PetugasController::class)
            ->names('dashboard.petugas')
            ->except(['edit', 'update'])
            ->parameters(['petugas' => 'user']);

    Route::get('pemohon/fetch', [PemohonController::class, 'getLatest'])->name('dashboard.pemohon.fetch');
    Route::resource('pemohon', PemohonController::class)
            ->names('dashboard.pemohon');

    Route::get('arsip/fetch', [ArsipController::class, 'getLatest'])->name('dashboard.arsip.fetch');
    Route::get('pemohon/get/{pemohon}', [ArsipController::class, 'getPemohon'])->name('dashboard.pemohon.get');
    Route::resource('arsip', ArsipController::class)->names('dashboard.arsip');
    
    Route::get('fileArsip/download/{id}', [ArsipController::class, 'downloadFile'])
            ->name('dashboard.fileArsip.download');

    Route::delete('fileArsip/{fileArsip}', [ArsipController::class, 'destroyFile'])->name('dashboard.fileArsip.destroy');
    
    Route::get('log-aktifitas', [LogProsesController::class, 'index'])->name('dashboard.log-aktifitas.index');
    Route::get('log-aktifitas/fetch', [LogProsesController::class, 'getLatest'])->name('dashboard.log-aktifitas.fetch');
    ROute::get('log-aktifitas/{logProses}', [LogProsesController::class, 'show'])->name('dashboard.log-aktifitas.show');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
