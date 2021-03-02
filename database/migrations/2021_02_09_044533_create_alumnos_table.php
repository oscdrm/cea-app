<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastName');
            $table->string('email');
            $table->string('phone');
            $table->date('inscription_date');
            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')->references('id')->on('carreras')->onUpdate('cascade');
            $table->unsignedBigInteger('modalidad_id');
            $table->foreign('modalidad_id')->references('id')->on('modalidads')->onUpdate('cascade');
            $table->unsignedBigInteger('tipo_inscripcion_id');
            $table->foreign('tipo_inscripcion_id')->references('id')->on('tipo_inscripcions')->onUpdate('cascade');
            
            $table->unsignedBigInteger('status_alumno_id');
            $table->foreign('status_alumno_id')->references('id')->on('status_alumnos')->onUpdate('cascade');
            
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
        Schema::dropIfExists('alumnos');
    }
}
