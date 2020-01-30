<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGambleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_gamble', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('gamble_id')->unsigned()->index();
            $table->integer('choice');
            $table->integer('point')->unsigned();
            $table->integer('return')->unsigned()->default(1);
            $table->integer('check')->default(0);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gamble_id')->references('id')->on('gambles')->onDelete('cascade');
            
            $table->unique(['user_id','gamble_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_gamble');
    }
}
