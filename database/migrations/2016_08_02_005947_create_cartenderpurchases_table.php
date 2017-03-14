<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartenderpurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartenderpurchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cartender_id')->unsigned();
            $table->foreign('cartender_id')->references('id')->on('cartenders');
            $table->integer('cartenderreserve_id')->unsigned();
            $table->foreign('cartenderreserve_id')->references('id')->on('cartenderreserves');
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
        Schema::drop('cartenderpurchases');
    }
}
