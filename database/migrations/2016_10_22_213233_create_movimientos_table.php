<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_stock')->unsigned();
            $table->date('fecha');
            $table->time('hora');
            $table->string('tipo');
            $table->integer('cantidad');
            $table->string('cantidad');
            $table->foreign('id_stock')->references('id')->on('stock')->onDelete('cascade');
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
        //
    }
}
