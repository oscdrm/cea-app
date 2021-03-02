<?php

use Illuminate\Database\Seeder;
use App\StatusAlumno;

class StatusAlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusAlumno::create([
            'name' => 'Activo',
            'description' => 'El alumo sigue activo y cursando con normalidad su licenciatura'
        ]);

        StatusAlumno::create([
            'name' => 'Baja Definitiva',
            'description' => 'El alumno ha terminado su relación con cea de manera definitiva'
        ]);

        StatusAlumno::create([
            'name' => 'Baja Temporal',
            'description' => 'El alumno esta dado de baja de manera temporal'
        ]);

        StatusAlumno::create([
            'name' => 'Egresado',
            'description' => 'El alumno ha concluido su licenciatura'
        ]);
    }
}
