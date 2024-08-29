<?php

namespace App\Providers;

use App\Http\Resources\EmpleadoResource;
use Livewire\Livewire;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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

        EmpleadoResource::withoutWrapping();

        Model::shouldBeStrict();

        URL::forceScheme('https');

        if(env('LOCAL') === "1"){

            URL::forceScheme('https');

            Livewire::setScriptRoute(function ($handle) {
                return Route::get('/sgesttionpersonal/public/vendor/livewire/livewire.js', $handle);
            });

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/sgesttionpersonal/public/livewire/update', $handle);
            });

        }elseif(env('LOCAL') === "0"){

            Livewire::setScriptRoute(function ($handle) {
                return Route::get('/sgesttionpersonal/public/vendor/livewire/livewire.js', $handle);
            });

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/sgesttionpersonal/public/livewire/update', $handle);
            });

        }

    }
}
