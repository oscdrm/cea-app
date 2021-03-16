<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    public function alumnos(){
        return $this->belongsToMany(Alumno::class, 'descuento_alumno');
    }

    public function concepto()
    {
        return $this->belongsTo(Concepto::class);
    }

}
