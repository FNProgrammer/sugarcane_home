<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_prices', function (Blueprint $table) {
            $table->id();
            $table->string('home-type');
            $table->bigInteger('price');
            $table->bigInteger('Compensatory');
            $table->date('from-date');
            $table->date('to-date');
            $table->boolean('activation')->default(0);
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
        Schema::dropIfExists('home_prices');
    }
}
