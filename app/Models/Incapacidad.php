<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Persona;
use App\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Incapacidad extends Model implements Auditable
{

    use HasFactory;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['folio', 'documento', 'tipo', 'persona_id', 'creado_por', 'actualizado_por', 'fecha_inicial', 'fecha_final', 'observaciones'];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function imagenUrl(){

        return $this->documento
                    ? Storage::disk('incapacidades')->url($this->documento)
                    : Storage::disk('public')->url('img/ico.png');

    }

    public function getFechaInicialFormateadaAttribute(){
        return Carbon::parse($this->attributes['fecha_inicial'])->format('d-m-Y');
    }

    public function getFechaFinalFormateadaAttribute(){
        return Carbon::parse($this->attributes['fecha_final'])->format('d-m-Y');
    }

}
