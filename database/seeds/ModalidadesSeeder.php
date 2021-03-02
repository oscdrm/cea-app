<?php

use Illuminate\Database\Seeder;
use App\Modalidad;

class ModalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modalidad::create([
            'name' => '3 años',
            'description' => 'Modalidad de escolaridad a 3 años'
        ]);

        Modalidad::create([
            'name' => '10 meses',
            'description' => 'Modalidad de escolaridad a 10 meses'
        ]);

        Modalidad::create([
            'name' => 'Nivelación',
            'description' => 'Modalidad de escolaridad de nivelación'
        ]);
    }
}
