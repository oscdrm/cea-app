<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostoCarrera extends Model
{
    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function concepto()
    {
        return $this->belongsTo(Concepto::class);
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class);
    }

}
