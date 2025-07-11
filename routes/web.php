<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Frond\FrondPagesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrondPagesController::class, 'index'])->name('welcome');

require __DIR__.'/auth.php';

Route::middleware('auth')->prefix('dashboard')->group( function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
