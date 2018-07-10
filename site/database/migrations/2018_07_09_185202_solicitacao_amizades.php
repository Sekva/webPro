<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SolicitacaoAmizades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('solicitacao_amizades', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('id_quem_pediu')->unsigned()->nullable(false);
          $table->integer('id_quem_recebeu')->unsigned()->nullable(false);


          $table->foreign('id_quem_pediu')->references('id')->on('users');
          $table->foreign('id_quem_recebeu')->references('id')->on('users');

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
        Schema::dropIfExists('solicitacao_amizades');
    }
}
