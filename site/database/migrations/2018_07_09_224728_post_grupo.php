<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('posts_grupos', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('id_post')->nullable(false);
          $table->integer('id_grupo')->nullable(false);


          $table->foreign('id_post')->references('id')->on('posts');
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
      Schema::dropIfExists('posts_grupos');
    }
}
