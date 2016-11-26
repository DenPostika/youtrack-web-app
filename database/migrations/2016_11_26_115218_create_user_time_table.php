<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tracker', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->references('id')->on('users');
          $table->string('date');
          $table->string('what_action');
          $table->integer('time');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tracker');
    }
}
