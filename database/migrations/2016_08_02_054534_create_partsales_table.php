<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partsales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_id')->unsigned()->nullable();
            $table->foreign('corporate_id')->references('id')->on('corporates');
            $table->integer('part_id')->unsigned();
            $table->foreign('part_id')->references('id')->on('parts');
            $table->integer('partgroup_id')->unsigned()->nullable();
            $table->foreign('partgroup_id')->references('id')->on('partgroups');
            $table->date('startdate')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->boolean('negotiable')->default(1);
            $table->boolean('locked')->default(0);
            $table->integer('salereserveholddays')->unsigned();
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
        Schema::drop('partsales');
    }
}
