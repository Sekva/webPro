<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteressesUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interesses_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 500)->nullable(true);
            $table->string('nome');
            $table->integer('id')->unsigned();
            $table->timestamps();


            $table->foreign('id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interesses_usuarios');
    }
}
