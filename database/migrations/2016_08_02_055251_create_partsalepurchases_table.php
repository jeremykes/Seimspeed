<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsalepurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partsalepurchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partsale_id')->unsigned();
            $table->foreign('partsale_id')->references('id')->on('partsales');
            $table->integer('partsalereserve_id')->unsigned();
            $table->foreign('partsalereserve_id')->references('id')->on('partsalereserves');
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
        Schema::drop('partsalepurchases');
    }
}
