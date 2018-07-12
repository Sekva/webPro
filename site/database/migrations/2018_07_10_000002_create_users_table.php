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
            $table->string('foto')->nullbale(false)->default('/storage/default.png');

            $table->integer('id_perfil_externo')->unsigned()->nullable(true);

            $table->longText('descricao')->nullable(true);


            $table->foreign('id_perfil_externo')->references('id')->on('perfis_externos');

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
