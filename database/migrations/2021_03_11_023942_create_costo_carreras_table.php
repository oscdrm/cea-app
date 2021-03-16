<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostoCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costo_carreras', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')->references('id')->on('carreras')->onUpdate('cascade');

            $table->unsignedBigInteger('concepto_id');
            $table->foreign('concepto_id')->references('id')->on('conceptos')->onUpdate('cascade');

            $table->unsignedBigInteger('modalidad_id')->nullable();
            $table->foreign('modalidad_id')->references('id')->on('modalidads')->onUpdate('cascade');

            $table->float('costo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costo_carreras');
    }
}
