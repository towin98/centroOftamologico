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
            $table->string('remiteEPS', 18);
            //$table->string('textColor',20);
            $table->date('fecha_cita');
            $table->dateTime('start');
            $table->dateTime('end');
            
            $table->unsignedBigInteger('user_id');
           

            $table->timestamps();


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
