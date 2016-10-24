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
            $table->string('provincia');
            $table->string('departamento');
            $table->string('region1');
            $table->string('region2');
            $table->string('tipo_cliente');
            $table->string('tipo_tienda');
            $table->integer('usr');
            $table->dateTime('dtime');
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
        Schema::drop('direccion_ubicacion');
    }
}
