<?php

namespace App\Models;

use App\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Justificacion extends Model implements Auditable
{

    use HasFactory;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['folio', 'documento', 'persona_id', 'creado_por', 'actualizado_por', 'observaciones'];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function retardo(){
        return $this->hasOne(Retardo::class);
    }

    public function falta(){
        return $this->hasOne(Falta::class);
    }

    public function imagenUrl(){

        return $this->documento
                    ? Storage::disk('justificacion')->url($this->documento)
                    : Storage::disk('public')->url('img/ico.png');

    }

}
