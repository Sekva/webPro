<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('permanente');
            $table->boolean('e_de_grupo');
            $table->string('texto')->nullable(false); //Descrição
            $table->string('conteudo', 600); //Seja foto ou texto (código ou não)

            $table->integer('id_autor')->unsigned()->nullable();


            $table->foreign('id_autor')->references('id')->on('users');

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
        Schema::dropIfExists('posts');
    }
}
