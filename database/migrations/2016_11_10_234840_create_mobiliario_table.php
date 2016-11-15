<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobiliarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobiliario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_id')->unsigned();
            $table->integer('subcategoria1_id')->unsigned();
            $table->integer('subcategoria2_id')->unsigned();
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categoria')->onDelete('cascade');
            $table->foreign('subcategoria1_id')->references('id')->on('subcategoria1')->onDelete('cascade');
            $table->foreign('subcategoria2_id')->references('id')->on('subcategoria2')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mobiliario');
    }
}
