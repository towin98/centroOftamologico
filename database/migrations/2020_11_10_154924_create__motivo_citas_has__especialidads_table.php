<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotivoCitasHasEspecialidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivo_citas_has__especialidads', function (Blueprint $table) {
            $table->unsignedBigInteger('MOTIVO_CITAS_id');
            $table->unsignedBigInteger('ESPECIALIDADS_id');
            $table->unsignedBigInteger('MEDICOS_id');
            $table->timestamps();

            $table->foreign('MOTIVO_CITAS_id')->references('id')->on('motivo_citas');
            $table->foreign('ESPECIALIDADS_id')->references('id')->on('especialidads');
            $table->foreign('MEDICOS_id')->references('id')->on('medicos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motivo_citas_has__especialidads');
    }
}
