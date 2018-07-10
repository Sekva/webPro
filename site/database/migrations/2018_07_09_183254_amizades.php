<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Amizades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('amizades', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('id_user1')->unsigned()->nullable(false);
          $table->integer('id_user2')->unsigned()->nullable(false);


          $table->foreign('id_user1')->references('id')->on('users');
          $table->foreign('id_user2')->references('id')->on('users');

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
        Schema::dropIfExists('amizades');
    }
}
