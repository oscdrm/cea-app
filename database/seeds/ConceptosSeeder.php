<?php

use Illuminate\Database\Seeder;
use App\Concepto;

class ConceptosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Concepto::create([
            'name' => 'Inscripción',
            'description' => 'Pago de inscripción'
        ]);

        Concepto::create([
            'name' => 'Mensualidad',
            'description' => 'Pago de mensualidad'
        ]);

    }
}
