<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsalepurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carsalepurchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carsale_id')->unsigned();
            $table->foreign('carsale_id')->references('id')->on('carsales');
            $table->integer('carsalereserve_id')->unsigned();
            $table->foreign('carsalereserve_id')->references('id')->on('carsalereserves');
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->decimal('tax', 10, 2)->default(0.00);
            $table->decimal('additionalfees', 10, 2)->default(0.00);
            $table->text('additionalfeesdescript')->nullable();
            $table->string('uniquepaymentid')->nullable();
            $table->string('method')->nullable();
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
        Schema::drop('carsalepurchases');
    }
}
