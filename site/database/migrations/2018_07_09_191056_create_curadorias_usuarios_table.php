<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuradoriasUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('curadorias_usuarios', function (Blueprint $table) {
            $table->increments('id')->nullable(false)->unsigned();
            $table->string('nome')->nullable(false);
            $table->string('descricao', 300)->nullable(false); //300 caracteres!
            $table->string('link')->nullable(false);
            $table->integer('usuario')->nullable(false);
            $table->foreing('usuario')->references('id')->on('users');
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
        Schema::dropIfExists('curadorias_usuarios');
    }
}
