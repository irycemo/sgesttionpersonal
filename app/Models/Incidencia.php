<?php

namespace App\Models;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = ['persona_id', 'tiempo_consumido', 'tipo', 'status'];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }
}
