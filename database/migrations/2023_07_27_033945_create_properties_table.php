<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->decimal('rent', 10, 2);
            $table->string('description')->nullable();
            $table->string('property_type')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('square_footage')->nullable();
            $table->integer('parking_spaces')->nullable();
            $table->json('amenities')->nullable();
            $table->unsignedBigInteger('property_owner_id')->nullable();
            $table->unsignedBigInteger('property_manager_id')->nullable();
            $table->string('availability_status')->nullable();
            $table->date('next_inspection_date')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
