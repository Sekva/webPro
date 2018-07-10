<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_autor')->unsigned()->nullable(false);
            $table->integer('id_post')->unsigned()->nullable(false);

            $table->longText('conteudo');
            $table->integer('avaliacao');


            $table->foreign('id_autor')->references('id')->on('users');
            $table->foreign('id_post')->references('id')->on('posts');

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
        Schema::dropIfExists('comentarios');
    }
}
