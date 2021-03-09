<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuentos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('discount');
            $table->timestamps();
        });

        Schema::create('descuento_alumno', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('descuento_id');
            $table->unsignedBigInteger('alumno_id');
            $table->timestamps();
    
            $table->unique(['descuento_id', 'alumno_id']);
    
            $table->foreign('descuento_id')
                ->references('id')
                ->on('descuentos')
                ->onDelete('cascade');
    
            $table->foreign('alumno_id')
                ->references('id')
                ->on('alumnos')
                ->onDelete('cascade');
    
        });

    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('descuentos');
    }
}
