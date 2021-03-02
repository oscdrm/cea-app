<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    public function pagos()
    {
        return $this->hasMany(MovimientosCaja::class);
    }

}
