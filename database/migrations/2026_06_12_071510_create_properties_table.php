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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Adding title to match UI
            $table->string('address');
            $table->unsignedInteger('bedrooms');
            $table->decimal('bathrooms', 3, 1)->unsigned();
            $table->decimal('price', 12, 2)->unsigned();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->decimal('area_sqft', 10, 2)->nullable(); // Adding area to match UI
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
