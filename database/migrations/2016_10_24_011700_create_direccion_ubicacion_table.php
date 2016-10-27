<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionUbicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion_ubicacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ciudad');
            $table->string('distrito');
            $table->integer('provincia_id')->unsigned();
            $table->integer('departamento_id')->unsigned();
            $table->integer('region1_id')->unsigned();
            $table->integer('region2_id')->unsigned();
            $table->integer('tipo_stock_id')->unsigned();
            $table->integer('usr');
            $table->dateTime('dtime');
            $table->timestamps();

            $table->foreign('provincia_id')->references('id')->on('provincia')->onDelete('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamento')->onDelete('cascade');
            $table->foreign('region1_id')->references('id')->on('region1')->onDelete('cascade');
            $table->foreign('region2_id')->references('id')->on('region2')->onDelete('cascade');
            $table->foreign('tipo_stock_id')->references('id')->on('tipo_stock')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('direccion_ubicacion');
    }
}
