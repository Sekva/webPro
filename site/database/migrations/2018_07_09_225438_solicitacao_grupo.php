<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SolicitacaoGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('solicitacoes_grupo', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('id_user_pedinte')->nullable(false);
          $table->integer('id_grupo_solicitado')->nullable(false);

          $table->foreign('id_user_pedinte')->references('id')->on('users');
          $table->foreign('id_grupo_solicitado')->references('id')->on('grupos');


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
      Schema::dropIfExists('solicitacoes_grupo');
    }
}
