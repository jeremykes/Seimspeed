<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsalereservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partsalereserves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partsale_id')->unsigned();
            $table->foreign('partsale_id')->references('id')->on('partsales');
            $table->integer('partsaleoffer_id')->unsigned();
            $table->foreign('partsaleoffer_id')->references('id')->on('partsaleoffers');
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
        Schema::drop('partsalereserves');
    }
}
