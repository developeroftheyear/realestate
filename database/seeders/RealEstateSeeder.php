<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Property;
use App\Models\RentProperty;
use App\Models\Agent;

class RealEstateSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'buyer', 'seller'] as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $adminRole = Role::where('name', 'admin')->first();

        $admin = User::firstOrCreate(
            ['email' => 'admin@tashleyhomes.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'role_id' => $adminRole?->id,
                'email_verified_at' => now(),
            ]
        );

        $admin->update([
            'role' => 'admin',
            'role_id' => $adminRole?->id,
            'email_verified_at' => $admin->email_verified_at ?? now(),
        ]);

        if (Property::exists()) {
            return;
        }

        Property::create([
            'title' => 'Spacious Family Home',
            'address' => '742 Evergreen Terrace, Springfield',
            'bedrooms' => 4,
            'bathrooms' => 2.5,
            'price' => 85000000.00,
            'area_sqft' => 2500,
            'is_featured' => true,
            'image_url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
            'description' => 'A charming, spacious family home featuring a large backyard, cozy fireplace, and an attached two-car garage. Located in a quiet, friendly neighborhood close to local parks and excellent schools.',
        ]);

        Property::create([
            'title' => 'Modern Canyon Masterpiece',
            'address' => '1008 Estate Drive, Beverly Hills',
            'bedrooms' => 6,
            'bathrooms' => 7.0,
            'price' => 125000000.00,
            'area_sqft' => 6500,
            'is_featured' => true,
            'image_url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80',
            'description' => 'A breathtaking architectural masterpiece with sweeping canyon views. Boasts an infinity-edge pool, private home theater, state-of-the-art chef\'s kitchen, and a separate guest pavilion.',
        ]);

        Property::create([
            'title' => 'Classic Victorian Townhouse',
            'address' => '221B Baker Street, London',
            'bedrooms' => 3,
            'bathrooms' => 1.5,
            'price' => 12000000.00,
            'area_sqft' => 1800,
            'is_featured' => false,
            'image_url' => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=800&q=80',
            'description' => 'Classic Victorian townhouse packed with character. High ceilings, original fireplaces, and study space. Ideally situated with excellent transport links and historical charm.',
        ]);

        Property::create([
            'title' => 'Luxury Skyline Penthouse',
            'address' => '455 Skyline Boulevard, San Francisco',
            'bedrooms' => 2,
            'bathrooms' => 2.0,
            'price' => 18500000.00,
            'area_sqft' => 2100,
            'is_featured' => false,
            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=800&q=80',
            'description' => 'Stunning modern penthouse featuring floor-to-ceiling windows with panoramic Bay views. Includes smart home automation, a wrap-around private terrace, and high-end luxury finishes throughout.',
        ]);

        Property::create([
            'title' => 'Cozy Suburban Retreat',
            'address' => '800 Maple Avenue, Riverdale',
            'bedrooms' => 3,
            'bathrooms' => 2.0,
            'price' => 4500000.00,
            'area_sqft' => 1600,
            'is_featured' => false,
            'image_url' => 'https://images.unsplash.com/photo-1583608205776-bfd35f0d9f83?auto=format&fit=crop&w=800&q=80',
            'description' => 'Lovely suburban retreat with mature landscaping, a modern open-concept kitchen, and a peaceful screened-in porch. Perfect for first-time buyers.',
        ]);

        // From RentPropertySeeder.php
RentProperty::create([
            'title' => 'Luxury Downtown Apartment',
            'location' => '123 Main St, Downtown',
            'monthly_rent' => 250000,
            'security_deposit' => 250000,
            'bedrooms' => 2,
            'bathrooms' => 2,
            'area_sqft' => 1200,
            'lease_term' => '12 months',
            'available_from' => now()->addDays(15),
            'description' => 'Stunning 2-bedroom apartment with city views, modern appliances, and 24/7 concierge.',
            'image_url' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800',
            'is_featured' => true,
            'is_pet_friendly' => true,
            'is_furnished' => true,
        ]);
        
        RentProperty::create([
            'title' => 'Cozy Suburban House',
            'location' => '456 Oak Ave, Suburbs',
            'monthly_rent' => 185000,
            'security_deposit' => 185000,
            'bedrooms' => 3,
            'bathrooms' => 2,
            'area_sqft' => 1600,
            'lease_term' => '6 months',
            'available_from' => now()->addDays(5),
            'description' => 'Family-friendly home with backyard, garage, and quiet neighborhood.',
            'image_url' => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800',
            'is_featured' => false,
            'is_pet_friendly' => true,
            'is_furnished' => false,
        ]);
        
        RentProperty::create([
            'title' => 'Modern Beachfront Condo',
            'location' => '789 Coastal Rd, Beachside',
            'monthly_rent' => 350000,
            'security_deposit' => 350000,
            'bedrooms' => 2,
            'bathrooms' => 2,
            'area_sqft' => 1100,
            'lease_term' => '12 months',
            'available_from' => now()->addDays(30),
            'description' => 'Ocean views, private balcony, pool access, and steps from the sand.',
            'image_url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800',
            'is_featured' => true,
            'is_pet_friendly' => false,
            'is_furnished' => true,
        ]);
        
        RentProperty::create([
            'title' => 'Urban Loft Studio',
            'location' => '101 Arts District',
            'monthly_rent' => 160000,
            'security_deposit' => 160000,
            'bedrooms' => 1,
            'bathrooms' => 1,
            'area_sqft' => 750,
            'lease_term' => '6 months',
            'available_from' => now()->addDays(10),
            'description' => 'Charming loft with exposed brick, high ceilings, and walkable to cafes.',
            'image_url' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800',
            'is_featured' => false,
            'is_pet_friendly' => true,
            'is_furnished' => false,
        ]);
        
        RentProperty::create([
            'title' => 'Spacious Penthouse',
            'location' => '500 Highrise Ave',
            'monthly_rent' => 600000,
            'security_deposit' => 600000,
            'bedrooms' => 4,
            'bathrooms' => 3,
            'area_sqft' => 2500,
            'lease_term' => '12 months',
            'available_from' => now()->addDays(2),
            'description' => 'Penthouse with panoramic views, private elevator, and luxury finishes.',
            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800',
            'is_featured' => true,
            'is_pet_friendly' => false,
            'is_furnished' => true,
        ]);

    }
}