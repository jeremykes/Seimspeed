<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarauctionreservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carauctionreserves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carauction_id')->unsigned();
            $table->foreign('carauction_id')->references('id')->on('carauctions');
            $table->integer('carauctionbid_id')->unsigned();
            $table->foreign('carauctionbid_id')->references('id')->on('carauctionbids');
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
        Schema::drop('carauctionreserves');
    }
}
