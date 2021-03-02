<?php

use Illuminate\Database\Seeder;
use App\Carrera;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carrera::create([
            'name' => 'Administración',
            'description' => 'Carrera de Administración'
        ]);

        Carrera::create([
            'name' => 'Derecho',
            'description' => 'Carrera de Derecho'
        ]);

        Carrera::create([
            'name' => 'Psicología',
            'description' => 'Carrera de Psicología'
        ]);

        Carrera::create([
            'name' => 'Pedagogía',
            'description' => 'Carrera de Pedagogía'
        ]);

        Carrera::create([
            'name' => 'Enfermeria',
            'description' => 'Carrera de Enfermeria'
        ]);

        Carrera::create([
            'name' => 'Preparatoria',
            'description' => 'Educación media superior'
        ]);

        Carrera::create([
            'name' => 'Curso de universidad',
            'description' => 'Curso de preparación para la universidad'
        ]);
    }
}
