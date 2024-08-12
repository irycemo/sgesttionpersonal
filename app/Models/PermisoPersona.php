<?php

namespace App\Models;

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

    protected $fillable = ['persona_id', 'permisos_id', 'creado_por', 'fecha_inicio', 'fecha_final', 'tiempo_consumido', 'status'];

    protected $table = 'permisos_persona';

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function permiso(){
        return $this->belongsTo(Permiso::class, 'permisos_id');
    }

}
