<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_log_in_and_access_panel(): void
    {
        $adminRole = Role::create(['name' => 'admin']);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@tashleyhomes.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'role_id' => $adminRole->id,
            'email_verified_at' => now(),
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('panel.dashboard', absolute: false));
        $this->assertAuthenticatedAs($admin);

        $this->get('/panel')->assertOk();
        $this->get('/panel/properties')->assertOk();
        $this->get('/panel/sell-inquiries')->assertOk();
    }

    public function test_non_admin_cannot_access_panel(): void
    {
        $user = User::factory()->create(['role' => 'buyer']);

        $response = $this->actingAs($user)->get('/panel');

        $response->assertRedirect(route('properties.index'));
    }
}
