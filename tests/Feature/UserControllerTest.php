<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    // set up the test
    public function setUp(): void
    {
        parent::setUp();
        // authenticate the user with Sanctum
        // create a user
        $user = User::factory()->create();

        // authenticate the user with Sanctum
        Sanctum::actingAs($user, ['*']);
        // Create seed data
        $this->artisan('migrate:fresh');
        $this->seed();
    }
    // not used currently
    // test to see if the user can be retrieved
//    public function test_can_retrieve_users()
//    {
//        // Arrange: Create some users
//        $user = User::factory()->create();
//
//        // Act: Make request
//        $response = $this->getJson('/api/v1/user');
//
//        // Assert: Assert that user data is seen
//        $response->assertStatus(200)
//            ->assertJsonFragment(['name' => $user->name]);
//    }

    // test to see if the user can be created
    public function test_can_create_user()
    {
        // Arrange: Prepare data
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'userRole' => 'user'

        ];

        // Act: Make request
        $response = $this->postJson('/api/v1/public/register', $data);

        // Assert: Assert that user is created
        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Test User']);
        $this->assertDatabaseHas('users', ['name' => 'Test User']);
    }

    // test to see if the user can be shown
    public function test_can_show_user()
    {
        // Arrange: Create user
        $user = User::factory()->create();

        // Act: Make request
        $response = $this->actingAs($user)->getJson("/api/v1/private/user/profile");

        // Assert: Assert that user data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $user->name]);
    }

    // test to see if the user can be updated
    public function test_can_update_user()
    {
        // Arrange: Create user
        $user = User::factory()->create();

        // Act: Update user
        $response = $this->actingAs($user)->patchJson("/api/v1/private/user/profile", [
            'name' => 'New Name',
        ]);

        // Assert: Assert that user is updated
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'New Name']);
        $this->assertDatabaseHas('users', ['name' => 'New Name']);
    }

    // test to see if the user can be deleted
    public function test_can_delete_user()
    {
        // Arrange: Create user
        $user = User::factory()->create();

        // Act: Delete user
        $response = $this->actingAs($user)->deleteJson("/api/v1/private/user/");

        // Assert: Assert that user is deleted
        $response->assertStatus(204);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
