<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userreports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reporting_user_id')->unsigned();
            $table->foreign('reporting_user_id')->references('id')->on('users');
            $table->integer('report_user_id')->unsigned();
            $table->foreign('report_user_id')->references('id')->on('users');
            $table->text('report')->nullable();
            $table->boolean('seen')->default(0);
            $table->boolean('valid')->default(0);
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
        Schema::drop('userreports');
    }
}
