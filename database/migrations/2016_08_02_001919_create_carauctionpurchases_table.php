<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarauctionpurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carauctionpurchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carauction_id')->unsigned();
            $table->foreign('carauction_id')->references('id')->on('carauctions');
            $table->integer('carauctionreserve_id')->unsigned();
            $table->foreign('carauctionreserve_id')->references('id')->on('carauctionreserves');
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
        Schema::drop('carauctionpurchases');
    }
}
