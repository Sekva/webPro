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
          $table->integer('adm_responsavel')->unsigned()->nullable(false);
          $table->integer('post')->unsigned()->nullable(false);
          $table->integer('autor_post')->unsigned()->nullable(false);
          $table->string('motivo');
          $table->timestamps();


          $table->foreign('adm_responsavel')->references('id')->on('adms');
          $table->foreign('post')->references('id')->on('posts');
          $table->foreign('autor_post')->references('id')->on('users');

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
