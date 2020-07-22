<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CityDeleveryTimes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('City_DeleveryTimes', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger("city_id");
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->unsignedInteger("delevery_id");
            $table->foreign('delevery_id')->references('id')->on('delevery_times')->onDelete('cascade');

            $table->boolean('status')->default(true);

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
        Schema::dropIfExists('City_DeleveryTimes');
    }
}
