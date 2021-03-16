<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConceptoToDescuento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('descuentos', function (Blueprint $table) {
            $table->unsignedBigInteger('concepto_id')->nullable();
            $table->foreign('concepto_id')->references('id')->on('conceptos')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('descuento', function (Blueprint $table) {
            //
        });
    }
}
