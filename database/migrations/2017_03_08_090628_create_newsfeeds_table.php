<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsfeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsfeeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carsale_id')->unsigned();
            $table->foreign('carsale_id')->references('id')->on('carsales');
            $table->integer('carrent_id')->unsigned();
            $table->foreign('carrent_id')->references('id')->on('carrents');
            $table->integer('cartender_id')->unsigned();
            $table->foreign('cartender_id')->references('id')->on('cartenders');
            $table->integer('carauction_id')->unsigned();
            $table->foreign('carauction_id')->references('id')->on('carauctions');
            $table->integer('partsale_id')->unsigned();
            $table->foreign('partsale_id')->references('id')->on('partsales');
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
        Schema::dropIfExists('newsfeeds');
    }
}
