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
        Schema::create('citas', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->string('title');
            $table->unsignedBigInteger('title'); //motivo_cita_id
            $table->unsignedBigInteger('id_medico');
            $table->text('descripcion')->nullable();
            $table->string('color', 18);
            $table->unsignedBigInteger('remiteEPS');
            //$table->string('textColor',20);
            $table->date('fecha_cita');
            $table->string('consultorio');
            $table->dateTime('start');
            $table->dateTime('end');
            
            $table->unsignedBigInteger('user_id');
            $table->string('orden',255);           
            $table->timestamp('asistio')->nullable();

            $table->timestamps();

            $table->foreign('remiteEPS')->references('id')->on('eps');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_medico')->references('id')->on('medicos');
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
    }
}
