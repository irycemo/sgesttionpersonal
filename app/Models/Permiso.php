<?php

namespace App\Models;

use App\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permiso extends Model implements Auditable
{

    use HasFactory;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['clave', 'descripcion', 'limite','creado_por', 'actualizado_por', 'tipo', 'tiempo'];

    public function personas(){
        return $this->belongsToMany(Persona::class)->withPivot(['tiempo_consumido', 'status']);
    }

}

