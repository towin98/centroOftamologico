<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoeps', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('eps', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('id_tipo_eps'); 
            $table->timestamps();
            
            $table->foreign('id_tipo_eps')->references('id')->on('tipoeps');
        });


        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('documentNumber')->unique();
            $table->string('tipo')->nullable();
            $table->string('name');
            $table->string('lastname');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');

            $table->string('direccion');
            $table->string('tipo_sangre');
            $table->unsignedBigInteger('tipo_eps');
            $table->string('photo')->nullable();
        
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('tipo_eps')->references('id')->on('eps');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('eps');
        Schema::dropIfExists('tipoeps');
    }
}
