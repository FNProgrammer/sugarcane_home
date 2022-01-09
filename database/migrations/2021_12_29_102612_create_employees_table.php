<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->unsigned();
            $table->string('name');
            $table->string('family');
            $table->bigInteger('national_id')->unsigned();
            $table->bigInteger('certificate_id')->unsigned();
            $table->Integer('child')->unsigned();
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->cascadeOnUpdate();
            $table->bigInteger('position_id')->unsigned();
            $table->foreign('position_id')->references('id')->on('positions')->cascadeOnUpdate();
            $table->boolean('status');
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
        Schema::dropIfExists('employees');
    }
}
