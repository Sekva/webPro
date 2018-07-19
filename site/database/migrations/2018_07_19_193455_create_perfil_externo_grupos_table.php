<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilExternoGruposTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('perfil_externo_grupos', function (Blueprint $table) {
      $table->increments('id');
      $table->string('nome')->nullable(false);
      $table->string('link')->nullable(false);

      $table->integer('grupo_id')->unsigned()->nullable(false);
      $table->foreign('grupo_id')->references('id')->on('grupos');

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
    Schema::dropIfExists('perfil_externo_grupos');
  }
}
