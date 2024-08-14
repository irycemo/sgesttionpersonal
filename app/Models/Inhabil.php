<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inhabil extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $fillable = ['fecha','descripcion', 'creado_por', 'actualizado_por'];

    public function getFechaFormateadaAttribute(){
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha'])->format('d-m-Y');
    }
}
