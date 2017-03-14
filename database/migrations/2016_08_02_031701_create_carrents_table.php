<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_id')->unsigned()->nullable();
            $table->foreign('corporate_id')->references('id')->on('corporates');
            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->references('id')->on('cars');
            $table->integer('cargroup_id')->unsigned()->nullable();
            $table->foreign('cargroup_id')->references('id')->on('cargroups');
            $table->date('startdate')->nullable();
            $table->decimal('rateperday', 10, 2)->default(0.00);
            $table->decimal('rateperhour', 10, 2)->default(0.00);
            $table->decimal('bondfee', 10, 2)->default(0.00);
            $table->integer('rentreserveholddays')->unsigned();
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
        Schema::drop('carrents');
    }
}
