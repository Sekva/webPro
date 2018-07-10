<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuradoriaGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curadoria_grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome')->nullable(false);
            $table->longText('descricao')->nullable(false);
            $table->string('link')->nullable(false);

            $table->integer('id_grupo')->unsigned()->nullable(false);


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
        Schema::dropIfExists('curadoria_grupos');
    }
}
