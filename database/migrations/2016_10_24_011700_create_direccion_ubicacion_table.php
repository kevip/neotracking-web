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
            $table->integer('ciudad_id')->unsigned();
            $table->integer('distrito_id')->unsigned();
            $table->integer('provincia_id')->unsigned();
            $table->integer('departamento_id')->unsigned();
            $table->integer('region1_id')->unsigned();
            $table->integer('region2_id')->unsigned();
            $table->dateTime('dtime');
            $table->timestamps();

            $table->foreign('provincia_id')->references('id')->on('provincia')->onDelete('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamento')->onDelete('cascade');
            $table->foreign('region1_id')->references('id')->on('region1')->onDelete('cascade');
            $table->foreign('region2_id')->references('id')->on('region2')->onDelete('cascade');
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
