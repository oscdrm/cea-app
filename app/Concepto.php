<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    public function adeudos()
    {
        return $this->hasMany(Adeudo::class);
    }

    public function pagos()
    {
        return $this->hasMany(MovimientosCaja::class);
    }


}
