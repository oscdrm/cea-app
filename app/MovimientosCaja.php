<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientosCaja extends Model
{
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function concepto()
    {
        return $this->belongsTo(Concepto::class);
    }

    public function metodoPago()
    {
        return $this->belongsTo('App\MetodoPago', 'metodo_pagos_id');
    }

    public function cajero()
    {
        return $this->belongsTo('App\User', 'cashier_id');
    }

    public function adeudo()
    {
        return $this->belongsTo(Adeudo::class);
    }
}
