<?php

namespace App\Providers;

use Livewire\Livewire;
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

        if(config('services.ses.flag')){

            Livewire::setScriptRoute(function ($handle) {
                return Route::get('/sgesttionpersonal/public/vendor/livewire/livewire.js', $handle);
            });

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/sgesttionpersonal/livewire/update', $handle);
            });

        }

    }

    public function overrideRoutes():void
    {

        Route::post('/livewire/upload-file', [CustomLivewireController::class, 'handle'])->name('livewire.upload-file')->middleware('web');

    }

}
