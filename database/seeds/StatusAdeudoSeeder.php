<?php

use Illuminate\Database\Seeder;
use App\StatusAdeudo;

class StatusAdeudoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusAdeudo::create([
            'name' => 'Adeudo',
            'description' => 'El pago de mensualidad o inscripción del alumno no se ha pagado aun'
        ]);

        StatusAdeudo::create([
            'name' => 'Pagado',
            'description' => 'El pago de mensualidad o inscripción del alumno se ha pagado'
        ]);
    }
}
