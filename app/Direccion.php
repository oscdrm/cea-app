<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
