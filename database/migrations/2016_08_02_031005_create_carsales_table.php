<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carsales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_id')->unsigned();
            $table->foreign('corporate_id')->references('id')->on('corporates');
            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->references('id')->on('cars');
            $table->integer('cargroup_id')->unsigned()->nullable();
            $table->foreign('cargroup_id')->references('id')->on('cargroups');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->date('startdate')->nullable();
            $table->integer('salereserveholddays')->unsigned();
            $table->boolean('negotiable')->default(1);
            $table->boolean('locked')->default(0);
            $table->string('status')->nullable();
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
        Schema::drop('carsales');
    }
}
