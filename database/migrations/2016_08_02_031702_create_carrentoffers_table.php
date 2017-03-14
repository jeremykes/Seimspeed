<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrentoffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrentoffers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carrent_id')->unsigned();
            $table->foreign('carrent_id')->references('id')->on('carrents');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('daysofrent')->unsigned();
            $table->decimal('offer', 10, 2)->default(0.00);
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
        Schema::drop('carrentoffers');
    }
}
