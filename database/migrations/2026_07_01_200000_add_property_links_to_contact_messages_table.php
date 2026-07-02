<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->foreignId('property_id')->nullable()->after('message')->constrained()->nullOnDelete();
            $table->foreignId('rent_property_id')->nullable()->after('property_id')->constrained('rent_properties')->nullOnDelete();
            $table->string('inquiry_type')->nullable()->after('rent_property_id');
            $table->boolean('is_read')->default(false)->after('inquiry_type');
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
            $table->dropForeign(['rent_property_id']);
            $table->dropColumn(['property_id', 'rent_property_id', 'inquiry_type', 'is_read']);
        });
    }
};
