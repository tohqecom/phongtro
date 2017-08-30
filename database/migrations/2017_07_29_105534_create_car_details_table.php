<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('car_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id');
            $table->string('gearbox');
            $table->float('fuel_consumption');
            $table->integer('engine_capacity');
            $table->integer('engine_power');
            $table->string('fuel');
            $table->integer('seats');
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
        Schema::dropIfExists('car_details');
    }
}
