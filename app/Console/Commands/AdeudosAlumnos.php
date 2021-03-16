<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Alumno;
use App\Modalidad;
use App\Concepto;
use App\Carrera;
use App\Adeudo;
use App\CostoCarrera;
use App\Descuento;

class AdeudosAlumnos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adeudos:alumnos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generar adeudo mensual de todos los alumnos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        return 0;
    }
}
