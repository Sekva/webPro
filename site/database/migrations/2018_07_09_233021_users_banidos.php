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

          $table->integer('id_adm_responsavel')->unsigned()->nullable(false);

          $table->string('nome_usuario')->nullable(false);
          $table->string('email_usuario')->nullable(false);
          $table->string('motivo')->nullable(false);


          $table->foreign('id_adm_responsavel')->references('id')->on('adms');

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
