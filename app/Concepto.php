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

    public function costosCarrera()
    {
        return $this->hasMany(CostoCarrera::class);
    }

    public function descuentos()
    {
        return $this->hasMany(Descuento::class);
    }

}
