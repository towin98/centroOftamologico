<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicoxsedes', function (Blueprint $table) {
            $table->unsignedBigInteger('medico_id');
            $table->unsignedBigInteger('sede_id');
            $table->unsignedBigInteger('turno_id');
            $table->timestamps();

            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->foreign('sede_id')->references('id')->on('sedes');
            $table->foreign('turno_id')->references('id')->on('turnos');
        });

        Schema::create('citas', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->string('title');
            $table->unsignedBigInteger('title'); //motivo_cita_id
            
            $table->text('descripcion')->nullable();
            $table->string('color', 18);
            $table->string('remiteEPS', 18);
            //$table->string('textColor',20);
            $table->date('fecha_cita');
            $table->dateTime('start');
            $table->dateTime('end');
            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('medicoxsede_medico_idmedico');
            $table->unsignedBigInteger('medicoxsede_sede_idsede');
            //$table->unsignedBigInteger('medicoxsede_turno_idturno');
          //  $table->unsignedBigInteger('horas_id');

            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('medicoxsede_medico_idmedico')->references('medico_id')->on('medicoxsedes');
            $table->foreign('medicoxsede_sede_idsede')->references('sede_id')->on('medicoxsedes');
            //$table->foreign('medicoxsede_turno_idturno')->references('turno_id')->on('medicoxsedes');
            //$table->foreign('horas_id')->references('id')->on('horas');
            $table->foreign('title')->references('id')->on('motivo_citas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
        Schema::dropIfExists('medicoxsedes');
    }
}
