<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frond\FrondPagesController;
use App\Http\Controllers\Dashboard\PemohonController;
use App\Http\Controllers\Dashboard\PetugasController;
use App\Http\Controllers\Dashboard\DashboardController;

Route::get('/', [FrondPagesController::class, 'index'])->name('welcome');

require __DIR__.'/auth.php';

Route::middleware('auth')->prefix('dashboard')->group( function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('petugas', PetugasController::class)
            ->names('dashboard.petugas')
            ->except(['edit', 'update'])
            ->parameters(['petugas' => 'user']);

    Route::get('pemohon/fetch', [PemohonController::class, 'getLatest'])->name('dashboard.pemohon.fetch');
    Route::resource('pemohon', PemohonController::class)
            ->names('dashboard.pemohon');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
