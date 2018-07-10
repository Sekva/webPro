<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostsExcluidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('posts_excluidos', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('id_adm_responsavel')->unsigned()->nullable(false);
          $table->integer('id_post')->unsigned()->nullable(false);
          $table->integer('id_autor_post')->unsigned()->nullable(false);

          $table->string('motivo')->nullable(false);;


          $table->foreign('id_adm_responsavel')->references('id')->on('adms');
          $table->foreign('id_post')->references('id')->on('posts');
          $table->foreign('id_autor_post')->references('id')->on('users');

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
      Schema::dropIfExists('posts_excluidos');
    }
}
