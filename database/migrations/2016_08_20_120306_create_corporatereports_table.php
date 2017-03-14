<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporatereportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporatereports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_id')->unsigned();
            $table->foreign('corporate_id')->references('id')->on('corporates');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('report')->nullable();
            $table->boolean('seen')->default(0);
            $table->boolean('valid')->default(0);
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
        Schema::drop('corporatereports');
    }
}
