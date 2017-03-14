<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partgroups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_id')->unsigned();
            $table->foreign('corporate_id')->references('id')->on('corporates');
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->boolean('published')->default(0);
            $table->boolean('autopublish')->default(0);
            $table->boolean('autounpublish')->default(0);
            $table->boolean('autopublishparts')->default(0);
            $table->boolean('autounpublishparts')->default(0);
            $table->boolean('autoreserveparts')->default(0);
            $table->string('title');
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
        Schema::drop('partgroups');
    }
}
