<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePropertyAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_property_assignment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('property_id');
            $table->date('assignment_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            // Add any other necessary columns here
            $table->timestamps();

            // Foreign key constraints to link to other tables
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_property_assignment');
    }
}
