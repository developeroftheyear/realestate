<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rent_properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->decimal('monthly_rent', 10, 2); // rent price per month
            $table->decimal('security_deposit', 10, 2); // deposit amount
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('area_sqft');
            $table->string('lease_term'); // e.g., "12 months", s"6 months"
            $table->date('available_from');
            $table->text('description');
            $table->string('image_url');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_pet_friendly')->default(false);
            $table->boolean('is_furnished')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_properties');
    }
};
