<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersBanidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users_banidos', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('adm_responsavel')->unsigned()->nullable(false);
          $table->string('nome_usuario');
          $table->string('email_usuario');
          $table->string('motivo');

          $table->foreign('adm_responsavel')->references('id')->on('adms');


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
      Schema::dropIfExists('users_banidos');
    }
}
