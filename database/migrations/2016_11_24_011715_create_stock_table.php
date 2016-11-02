<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_id')->unsigned();
            $table->integer('status')->unsigned();
            $table->integer('subcategoria1_id')->unsigned();
            $table->integer('subcategoria2_id')->unsigned();
            $table->integer('tienda_id')->unsigned();
            $table->integer('cantidad');
            $table->string('codigo')->unique();
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categoria')->onDelete('cascade');
            $table->foreign('status')->references('id')->on('stock_status')->onDelete('cascade');
            $table->foreign('subcategoria1_id')->references('id')->on('subcategoria1')->onDelete('cascade');
            $table->foreign('subcategoria2_id')->references('id')->on('subcategoria2')->onDelete('cascade');
            $table->foreign('tienda_id')->references('id')->on('tienda')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stock');
    }
}
