<?php

namespace App\Models;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checador extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

}
