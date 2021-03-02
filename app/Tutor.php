<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
