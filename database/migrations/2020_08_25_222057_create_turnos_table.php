<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_medico');
            $table->string('nombre');
            $table->date('dia_turno');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->unsignedBigInteger('id_consultorio');
            $table->timestamps();

            $table->foreign('id_medico')->references('id')->on('medicos');
            $table->foreign('id_consultorio')->references('id')->on('consultorios');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turnos');
    }
}
