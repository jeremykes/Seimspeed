<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargroups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_id')->unsigned();
            $table->foreign('corporate_id')->references('id')->on('corporates');
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->string('title');
            $table->string('type')->nullable();
            $table->boolean('published')->default(0);
            $table->boolean('autopublish')->default(0); //publish group on startdate
            $table->boolean('autounpublish')->default(0); //unpublish group on enddate
            $table->boolean('autopublishcars')->default(0); //publish all cars on startdate
            $table->boolean('autounpublishcars')->default(0); //take all cars offline at enddate
            $table->boolean('autoreservecars')->default(0); //when enddate is reached and offers and tenders are pending
            $table->text('descript')->nullable();
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
        Schema::drop('cargroups');
    }
}
