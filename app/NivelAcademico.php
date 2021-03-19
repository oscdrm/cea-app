<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelAcademico extends Model
{
    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }

    public function ofertasEducativas()
    {
        return $this->hasMany(Carrera::class);
    }
}
