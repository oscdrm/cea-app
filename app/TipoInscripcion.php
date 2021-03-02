<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoInscripcion extends Model
{
    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }
}
