<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_sending')->unsigned();
            $table->foreign('user_id_sending')->references('id')->on('users');
            $table->integer('user_id_receiving')->unsigned();
            $table->foreign('user_id_receiving')->references('id')->on('users');
            $table->text('message')->nullable();
            $table->boolean('seen')->default(0);
            $table->boolean('read')->default(0);
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
        Schema::drop('messages');
    }
}
