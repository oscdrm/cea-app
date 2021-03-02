<?php

use Illuminate\Database\Seeder;
use App\MetodoPago;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        MetodoPago::create([
            'name' => 'Deposito'
        ]);
        
        MetodoPago::create([
            'name' => 'Efectivo'
        ]);

        MetodoPago::create([
            'name' => 'Transferencia'
        ]);

    }
}
