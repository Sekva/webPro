<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModeradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moderadores', function (Blueprint $table) {
            $table->increments('id')->nullable(false)->unsigned();

            $table->integer('id_grupo')->nullable(false); //Grupo a ser moderado
            $table->foreing('id_grupo')->references('id')->on('grupos');

            $table->integer('id_user')->nullable(false); //Moderador
            $table->foreing('id_user')->references('id')->on('users');
            
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
        Schema::dropIfExists('moderadores');
    }
}
