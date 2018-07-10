<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_grupos', function (Blueprint $table) {
            $table->increments('id')->nullable(false)->unsigned();
            $table->integer('id_grupo')->nullable(false);
            $table->foreing('id_grupo')->references('id')->on('grupos');
            $table->integer('id_user')->nullable(false);
            $table->foreing('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('users_grupos');
    }
}
