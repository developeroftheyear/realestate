<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RentProperty;

class RentPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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


