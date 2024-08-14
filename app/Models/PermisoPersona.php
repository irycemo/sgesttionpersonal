<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Permiso;
use App\Models\Persona;
use App\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermisoPersona extends Model implements Auditable
{

    use HasFactory;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    /* Status ? 1 contabilizado : no contabilizado */

    protected $fillable = ['persona_id', 'permiso_id', 'creado_por', 'fecha_inicio', 'fecha_final', 'tiempo_consumido', 'status'];

    protected $table = 'permiso_persona';

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function permiso(){
        return $this->belongsTo(Permiso::class, 'permiso_id');
    }

    public function getFechaInicioFormateadaAttribute(){
        return Carbon::parse($this->attributes['fecha_inicio'])->format('d-m-Y H:i:s');
    }

    public function getFechaFinalFormateadaAttribute(){
        return Carbon::parse($this->attributes['fecha_final'])->format('d-m-Y H:i:s');
    }

}
