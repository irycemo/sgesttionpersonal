<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Horario;
use App\Models\Permiso;
use App\Models\Retardo;
use App\Models\Checador;
use App\Models\Incidencia;
use App\Models\Incapacidad;
use App\Traits\ModelosTrait;
use App\Models\Justificacion;
use App\Models\PermisoPersona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persona extends Model implements Auditable
{

    use HasFactory;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = ['id', 'created_at','updated_at'];

    public function horario(){
        return $this->belongsTo(Horario::class);
    }

    public function incapacidades(){
        return $this->hasMany(Incapacidad::class);
    }

    public function justificaciones(){
        return $this->hasMany(Justificacion::class);
    }

    public function retardos(){
        return $this->hasMany(Retardo::class);
    }

    public function faltas(){
        return $this->hasMany(Falta::class);
    }

    public function checados(){
        return $this->hasMany(Checador::class);
    }

    public function ultimoChecado(){
        return $this->hasOne(Checador::class)->latest();
    }

    public function incidencias(){
        return $this->hasMany(Incidencia::class);
    }

    public function permisos(){
        return $this->belongsToMany(Permiso::class)->withPivot(['id', 'fecha_inicio', 'fecha_final', 'tiempo_consumido'])->withTimestamps();
    }

    public function permisos2(){
        return $this->hasMany(PermisoPersona::class);
    }

    public function tiempoConsumidoPermisos(){

        return $this->permisos2()
                        ->whereNull('status')
                        ->whereYear('created_at', Carbon::now()->year)
                        ->sum('tiempo_consumido');

    }

    public function tiempoConsumidoIncidencias(){

        return $this->incidencias()
                    ->where('status', false)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->sum('tiempo_consumido');

    }

    public function permisosEconomicos(){

        return $this->permisos2()
                        ->whereYear('created_at', Carbon::now()->year)
                        ->whereHas('permiso', function($q){
                            $q->where('descripcion','PERMISO ECONÓMICO');
                        })
                        ->count();
    }

    public function imagenUrl(){

        return $this->foto
                    ? Storage::disk('personal')->url($this->foto)
                    : Storage::disk('public')->url('img/unknown_user.png');

    }

    public function getFechaIngresoFormateadaAttribute(){
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_ingreso'])->format('d-m-Y');
    }

}
