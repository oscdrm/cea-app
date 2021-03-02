<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CarrerasSeeder::class);
        $this->call(ConceptosSeeder::class);
        $this->call(ModalidadesSeeder::class);
        $this->call(StatusAdeudoSeeder::class);
        $this->call(TipoInscripcionSeeder::class);
        $this->call(StatusAlumnoSeeder::class);
        $this->call(MetodoPagoSeeder::class);
    }
}
