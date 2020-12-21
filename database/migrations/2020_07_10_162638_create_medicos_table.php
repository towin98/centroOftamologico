<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
      /*   Schema::create('especialidads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
        }); */


        Schema::create('medicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            /* $table->unsignedBigInteger('id_especialidad')->nullable(); */
            $table->unsignedBigInteger('id_user')->nullable();  //quitar nullable a futuro, para pruebas dejar

            $table->text('descripcion_perfil',255)->nullable(); //aun sin utulizar 
            $table->string('photo');//quitar a futuro esta columna ya que se utiliza foto de registro
            $table->timestamps();
                        
          /*   $table->foreign('id_especialidad')->references('id')->on('especialidads'); */
            $table->foreign('id_user')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicos');
      /*   Schema::dropIfExists('especialidads'); */
    }
}
