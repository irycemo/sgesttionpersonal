<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Livewire\CustomLivewireController;

class LivewireOverrideServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        $this->overrideRoutes();

    }

    public function overrideRoutes():void
    {

        Route::post('/livewire/upload-file', [CustomLivewireController::class, 'handle'])->name('livewire.upload-file')->middleware('web');

    }

}
