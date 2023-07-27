<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    

    public function testAdminCanAccessAdminRoutes()
    {
        // Create an admin user and set the role
        $user = User::factory()->create(); 
        $user->role()->associate(Role::where('name', 'admin')->first());
        $user->save();

        // Simulate a request to an admin route
        $response = $this->actingAs($user)
            ->get(route('admin.dashboard'));

        // Assert that the response is successful (HTTP status 200)
        $response->assertStatus(200);
    }

    public function testNonAdminCannotAccessAdminRoutes()
    {
        // Create a non-admin user and set the role
        $user = factory(User::class)->create(); 
        $user->role()->associate(Role::where('name', 'property_manager')->first());
        $user->save();

        // Simulate a request to an admin route
        $response = $this->actingAs($user)
            ->get(route('admin.dashboard'));

        // Assert that the response is unauthorized (HTTP status 403)
        $response->assertStatus(403);
    }
}
