<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteressesGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interesses_grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 500)->nullable(true);
            $table->string('nome')->nullable(false);

            $table->integer('id_grupo')->nullable(false);


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
        Schema::dropIfExists('interesses_grupos');
    }
}
