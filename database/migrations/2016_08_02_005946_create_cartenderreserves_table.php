<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartenderreservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartenderreserves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cartender_id')->unsigned();
            $table->foreign('cartender_id')->references('id')->on('cartenders');
            $table->integer('cartendertender_id')->unsigned();
            $table->foreign('cartendertender_id')->references('id')->on('cartendertenders');
            $table->text('note')->nullable()->nullable();
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
        Schema::drop('cartenderreserves');
    }
}
