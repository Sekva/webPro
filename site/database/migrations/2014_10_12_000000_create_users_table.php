<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('foto')->nullbale(false);

            $table->integer('id_perfil_externo')->nullable(true);

            $table->string('descricao', 500)->nullable(true);


            $table->foreing('id_perfil_externo')->references('id')->on('perfis_externos');

            $table->timestamps();
            $table->rememberToken(); //???????diabéisso????????
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
