<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id')->nullable(false)->unsigned();
            $table->string('name')->nullable(false);
            $table->string('foto')->nullbale(false);
            $table->integer('perfil_externo')->nullable(true);
            $table->foreing('perfil_externo')->references('id')->on('perfis_externos');
            $table->string('descricao', 500)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
