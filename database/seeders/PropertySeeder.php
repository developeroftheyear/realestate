<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
