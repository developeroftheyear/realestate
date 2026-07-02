<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->integer('experience_years')->default(0);
            $table->timestamps();
        });

        Schema::create('sell_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('property_address');
            $table->string('property_type');
            $table->decimal('estimated_value', 12, 2)->nullable();
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });

        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->constrained('roles')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
        Schema::dropIfExists('roles');
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('sell_inquiries');
        Schema::dropIfExists('agents');
        Schema::dropIfExists('rent_properties');
        Schema::dropIfExists('properties');
    }
};