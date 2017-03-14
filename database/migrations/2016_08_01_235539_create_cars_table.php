<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_id')->unsigned();
            $table->foreign('corporate_id')->references('id')->on('corporates');
            $table->date('datebought')->nullable();
            $table->date('dateregistered')->nullable();
            $table->decimal('weight', 10, 2)->default(0.00);
            $table->string('plates')->nullable();
            $table->string('color')->nullable();
            $table->string('fueltype')->nullable();
            $table->string('transmissiontype')->nullable();
            $table->string('2wd4wd')->nullable();
            $table->string('steeringside')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('bodytype')->nullable();
            $table->string('status')->nullable();
            $table->text('note')->nullable();
            $table->text('physicallocation')->nullable();
            $table->boolean('ingroup')->default(0);
            $table->boolean('published')->default(0);
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
        Schema::drop('cars');
    }
}
