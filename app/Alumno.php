<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    public function tipoInscripcion()
    {
        return $this->belongsTo(TipoInscripcion::class);
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function status()
    {
        return $this->belongsTo('App\StatusAlumno', 'status_alumno_id');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class);
    }
    
    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }

    public function adeudos()
    {
        return $this->hasMany(Adeudo::class);
    }
    
    public function pagos()
    {
        return $this->hasMany(MovimientosCaja::class);
    }

    public function descuentos(){
        return $this->belongsToMany(Descuento::class, 'descuento_alumno');
    }

}
