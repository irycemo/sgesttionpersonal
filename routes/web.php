<?php

use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Audits;
use App\Livewire\Admin\Horarios;
use App\Livewire\Admin\Permisos;
use App\Livewire\Admin\Usuarios;
use App\Livewire\Inabil\Inabiles;
use App\Livewire\Admin\Permissions;
use App\Livewire\Formatos\Formatos;
use App\Livewire\Personal\Personal;
use App\Livewire\Reportes\Reportes;
use Illuminate\Support\Facades\Route;
use App\Livewire\Incapacidad\Incapacidades;
use App\Livewire\Justificacion\Justificaciones;
use App\Http\Controllers\Manual\ManualController;
use App\Http\Controllers\Persona\PersonaController;
use App\Http\Controllers\Auth\SetPasswordController;
use App\Http\Controllers\Checador\ChecadorController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Livewire\Asignacion\Asignacion;

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

    Route::get('inhabiles', Inabiles::class)->middleware('permission:Lista de inhabiles')->name('inhabiles');

    Route::get('auditoria', Audits::class)->middleware('permission:Lista de usuarios')->name('auditoria');

    Route::get('manual', ManualController::class)->name('manual');

    /* Incapacidades */
    Route::get('incapacidadess', Incapacidades::class)->middleware('permission:Lista de incapacidades')->name('incapacidades');

    /* Justificaciones */
    Route::get('justificaciones', Justificaciones::class)->middleware('permission:Lista de justificaciones')->name('justificaciones');

    /* Personal */
    Route::get('empleados', Personal::class)->middleware('permission:Lista de personal')->name('empleados');
    Route::get('personal_detalle/{persona}', PersonaController::class)->middleware('permission:Ver personal')->name('personal_detalle');

    /* Reportes */
    Route::get('reportes', Reportes::class)->middleware('permission:Reportes')->name('reportes');

    /* formatos */
    Route::get('formatos', Formatos::class)->middleware('permission:Formatos')->name('formatos');

    /* Asignación */
    Route::get('asignacion', Asignacion::class)->middleware('permission:Asignación')->name('asignacion');

    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

});


Route::get('setpassword/{email}', [SetPasswordController::class, 'create'])->name('setpassword');
Route::post('setpassword', [SetPasswordController::class, 'store'])->name('setpassword.store');

/* Chacador */
Route::get('checador', ChecadorController::class)->name('checador');
