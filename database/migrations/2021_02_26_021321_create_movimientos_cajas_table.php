<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos_cajas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('concepto_id')->nullable();
            $table->foreign('concepto_id')->references('id')->on('conceptos')->onUpdate('cascade');

            $table->string('otro_concepto')->nullable();

            $table->unsignedBigInteger('alumno_id')->nullable();
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onUpdate('cascade');

            $table->string('otro_alumno')->nullable();

            $table->unsignedBigInteger('metodo_pagos_id');
            $table->foreign('metodo_pagos_id')->references('id')->on('metodo_pagos')->onUpdate('cascade');

            $table->float('monto_pago');

            $table->string('folio')->unique()->nullable();

            $table->unsignedBigInteger('adeudo_id')->nullable();
            $table->foreign('adeudo_id')->references('id')->on('adeudos')->onUpdate('cascade');

            $table->unsignedBigInteger('cashier_id');
            $table->foreign('cashier_id')->references('id')->on('users')->onUpdate('cascade');

            $table->text('nota')->nullable();     

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
        Schema::dropIfExists('movimientos_cajas');
    }
}
