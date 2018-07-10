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
            $table->increments('id')->nullable(false)->unsigned();
            $table->string('nome')->nullable(false);
            $table->string('descricao', 300)->nullable(false); //300 caracteres!
            $table->string('link')->nullable(false);
            $table->integer('grupos')->nullable(false);
            $table->foreing('grupos')->references('id')->on('grupos');
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
