<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrentreservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrentreserves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carrent_id')->unsigned();
            $table->foreign('carrent_id')->references('id')->on('carrents');
            $table->integer('carrentoffer_id')->unsigned();
            $table->foreign('carrentoffer_id')->references('id')->on('carrentoffers');
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
        Schema::drop('carrentreserves');
    }
}
