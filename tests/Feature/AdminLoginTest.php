<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that admin can view login page.
     */
    public function test_admin_login_page_is_accessible(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Test that admin user can login with correct credentials.
     */
    public function test_admin_can_login_with_correct_credentials(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@cafenoir.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@cafenoir.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    /**
     * Test that admin cannot login with incorrect password.
     */
    public function test_admin_cannot_login_with_incorrect_password(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@cafenoir.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@cafenoir.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    /**
     * Test that non-admin user cannot access admin dashboard.
     */
    public function test_non_admin_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    /**
     * Test that admin user can access admin dashboard.
     */
    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    /**
     * Test that guest cannot access admin dashboard.
     */
    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    /**
     * Test that admin can logout.
     */
    public function test_admin_can_logout(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->post('/logout');

        $this->assertGuest();
    }
}
