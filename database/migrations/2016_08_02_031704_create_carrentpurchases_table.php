<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrentpurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrentpurchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carrent_id')->unsigned();
            $table->foreign('carrent_id')->references('id')->on('carrents');
            $table->integer('carrentreserve_id')->unsigned();
            $table->foreign('carrentreserve_id')->references('id')->on('carrentreserves');
            $table->integer('daysofrent')->unsigned();
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
        Schema::drop('carrentpurchases');
    }
}
