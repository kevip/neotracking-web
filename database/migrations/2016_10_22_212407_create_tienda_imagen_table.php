<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendaImagenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tienda_imagen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tienda_id')->unsigned();
            $table->string('url');
            $table->string('name');
            $table->string('type');
            $table->foreign('tienda_id')->references('id')->on('tienda')->onDelete('cascade');
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
        Scehma::drop('tienda_imagen');
    }
}
