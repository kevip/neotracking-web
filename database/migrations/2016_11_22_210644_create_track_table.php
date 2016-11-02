<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tienda_id')->unsigned();
            $table->string('codigo');
            $table->string('obs');
            $table->decimal('lat',8,6);
            $table->decimal('lng',9,6);
            $table->string('num');
            $table->string('flag');
            $table->string('guid')->unique();
            $table->integer('usr');
            $table->dateTime('dtime');
            $table->timestamps();

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
        Schema::drop('track');
    }
}
