<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsalereservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carsalereserves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carsale_id')->unsigned();
            $table->foreign('carsale_id')->references('id')->on('carsales');
            $table->integer('carsaleoffer_id')->unsigned();
            $table->foreign('carsaleoffer_id')->references('id')->on('carsaleoffers');
            $table->text('note')->nullable();
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
        Schema::drop('carsalereserves');
    }
}
