<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }
}
