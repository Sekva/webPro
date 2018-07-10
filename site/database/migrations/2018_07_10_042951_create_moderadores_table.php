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
            $table->increments('id');

            $table->integer('id_grupo')->nullable(false); //Grupo a ser moderado
            $table->integer('id_user')->nullable(false); //Moderador


            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_grupo')->references('id')->on('grupos');

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
