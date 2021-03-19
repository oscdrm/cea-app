<?php

use Illuminate\Database\Seeder;
use App\NivelAcademico;

class NivelAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NivelAcademico::create([
            'name' => 'Preparatoria'
        ]);

        NivelAcademico::create([
            'name' => 'Licenciatura'
        ]);
    }
}
