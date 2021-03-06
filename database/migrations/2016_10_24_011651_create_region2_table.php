<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegion2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('region1_id')->unsigned();
            $table->timestamps();

            $table->foreign('region1_id')->references('id')->on('region1')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('region2');
    }
}
