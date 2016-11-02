<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tienda', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('channel_id')->unsigned();
            $table->integer('direccion_ubicacion_id')->unsigned();
            $table->integer('retail_id')->unsigned();
            $table->integer('tipo_tienda_id')->unsigned();
            $table->string('direccion');
            $table->string('name');
            $table->string('state');
            $table->timestamps();

            $table->foreign('channel_id')->references('id')->on('channel')->onDelete('cascade');
            $table->foreign('direccion_ubicacion_id')->references('id')->on('direccion_ubicacion')->onDelete('cascade');
            $table->foreign('retail_id')->references('id')->on('retail')->onDelete('cascade');
            $table->foreign('tipo_tienda_id')->references('id')->on('tipo_tienda')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tienda');
    }
}
