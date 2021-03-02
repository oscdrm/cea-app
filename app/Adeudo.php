<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adeudo extends Model
{
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function concepto()
    {
        return $this->belongsTo(Concepto::class);
    }

    public function status()
    {
        return $this->belongsTo('App\StatusAdeudo', 'status_adeudo_id');
    }

    public function pagos()
    {
        return $this->hasMany(MovimientosCaja::class);
    }

}
