<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoExcluidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_excluidos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_adm')->nullable(false);

            $table->string('nome')->nullable(false);
            $table->string('motivo')->nullable(false);


            $table->foreign('id_adm')->references('id')->on('adms');

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
        Schema::dropIfExists('grupo_excluidos');
    }
}
