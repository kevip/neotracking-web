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
            $table->string('nombre');
            $table->integer('categoria_id')->unsigned();
            $table->integer('tipo_stock')->unsigned();
            $table->integer('subcategoria1_id')->unsigned();
            $table->integer('subcategoria2_id')->unsigned();
            $table->integer('tienda_id')->unsigned();
            $table->integer('ubicacion_id')->unsigned();
            $table->string('codigo')->unique();
            $table->date('fecha');
            $table->string('imagen');
            $table->string('descripcion');
            $table->string('observacion');
            $table->integer('cantidad');
            $table->enum('status',['alta', 'baja', 'pendiente'])->default('alta');
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categoria')->onDelete('cascade');
            $table->foreign('subcategoria1_id')->references('id')->on('subcategoria1')->onDelete('cascade');
            $table->foreign('subcategoria2_id')->references('id')->on('subcategoria2')->onDelete('cascade');
            $table->foreign('ubicacion_id')->references('id')->on('ubicacion')->onDelete('cascade');
            $table->foreign('tipo_stock')->references('id')->on('tipo_stock')->onDelete('cascade');
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
