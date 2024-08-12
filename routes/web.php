<?php

use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Audits;
use App\Livewire\Admin\Horarios;
use App\Livewire\Admin\Permisos;
use App\Livewire\Admin\Usuarios;
use App\Livewire\Admin\Permissions;
use Illuminate\Support\Facades\Route;
use App\Livewire\Incapacidad\Incapacidades;
use App\Http\Controllers\Manual\ManualController;
use App\Http\Controllers\Auth\SetPasswordController;
use App\Http\Controllers\Dashboard\DashboardController;

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => ['auth', 'esta.activo']], function(){

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::get('roles', Roles::class)->middleware('permission:Lista de roles')->name('roles');

    Route::get('permissions', Permissions::class)->middleware('permission:Lista de permisos')->name('permissions');

    Route::get('usuarios', Usuarios::class)->middleware('permission:Lista de usuarios')->name('usuarios');

    Route::get('horarios', Horarios::class)->middleware('permission:Lista de horarios')->name('horarios');

    Route::get('permisos', Permisos::class)->middleware('permission:Lista de permisos')->name('permisos');

    Route::get('auditoria', Audits::class)->middleware('permission:Lista de usuarios')->name('auditoria');

    Route::get('manual', ManualController::class)->name('manual');

    /* incapacidades */
    Route::get('incapacidadess', Incapacidades::class)->middleware('permission:Lista de incapacidades')->name('incapacidades');

});


Route::get('setpassword/{email}', [SetPasswordController::class, 'create'])->name('setpassword');
Route::post('setpassword', [SetPasswordController::class, 'store'])->name('setpassword.store');
