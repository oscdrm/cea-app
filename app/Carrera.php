<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }

    public function costosCarrera()
    {
        return $this->hasMany(CostoCarrera::class);
    }

    public function nivelAcademico()
    {
        return $this->belongsTo(NivelAcademico::class);
    }

}
