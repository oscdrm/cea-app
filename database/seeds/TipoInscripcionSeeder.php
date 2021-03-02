<?php

use Illuminate\Database\Seeder;
use App\TipoInscripcion;

class TipoInscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoInscripcion::create([
            'name' => 'Beca-Lealtad',
            'description' => 'El alumno no paga inscripción'
        ]);

        TipoInscripcion::create([
            'name' => 'Normal',
            'description' => 'El alumno paga el total de la inscripción'
        ]);
    }
}
