<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Pemohon\PemohonService;
use App\Services\Petugas\PetugasService;
use App\Services\Pemohon\PemohonServiceInterface;
use App\Services\Petugas\PetugasServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The application's service container bindings.
     *
     * @var array
     */
    public $singletons = [
        PetugasServiceInterface::class => PetugasService::class,
        PemohonServiceInterface::class => PemohonService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
