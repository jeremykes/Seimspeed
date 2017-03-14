<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarauctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carauctions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_id')->unsigned();
            $table->foreign('corporate_id')->references('id')->on('corporates');
            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->references('id')->on('cars');
            $table->integer('cargroup_id')->unsigned()->nullable();
            $table->foreign('cargroup_id')->references('id')->on('cargroups');
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->decimal('startbidprice', 10, 2)->default(0.00);
            $table->boolean('signuprequired')->default(0);
            $table->decimal('signupfee', 10, 2)->default(0.00);
            $table->integer('auctionreserveholddays')->unsigned();
            $table->string('status')->nullable();
            $table->boolean('locked')->default(0);
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
        Schema::drop('carauctions');
    }
}
