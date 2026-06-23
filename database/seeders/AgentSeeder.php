<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agent::create([
            'name' => 'Sarah Jenkins',
            'email' => 'sarah.j@tashleyhomes.com',
            'phone' => '+1 (555) 123-4567',
            'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
            'bio' => 'Sarah specializes in luxury downtown properties with over a decade of experience matching clients with their dream high-rise apartments.',
            'experience_years' => 12,
        ]);

        Agent::create([
            'name' => 'Michael Chen',
            'email' => 'michael.c@tashleyhomes.com',
            'phone' => '+1 (555) 987-6543',
            'photo' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80',
            'bio' => 'A former architect, Michael brings a unique perspective to real estate, helping clients see the true potential of every property.',
            'experience_years' => 8,
        ]);

        Agent::create([
            'name' => 'Jessica Alba',
            'email' => 'jessica.a@tashleyhomes.com',
            'phone' => '+1 (555) 456-7890',
            'photo' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80',
            'bio' => 'Jessica is an expert in suburban family homes, with deep knowledge of local school districts and community amenities.',
            'experience_years' => 15,
        ]);
        
        Agent::create([
            'name' => 'David Rodriguez',
            'email' => 'david.r@tashleyhomes.com',
            'phone' => '+1 (555) 321-0987',
            'photo' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
            'bio' => 'David is the go-to agent for commercial real estate and investment properties, providing unmatched market analysis and negotiation skills.',
            'experience_years' => 20,
        ]);
    }
}
