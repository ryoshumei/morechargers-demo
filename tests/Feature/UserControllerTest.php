<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    // set up the test
    public function setUp(): void
    {
        parent::setUp();
        // Create seed data
        $this->seed();
    }

    // test to see if the user can be retrieved
    public function test_can_retrieve_users()
    {
        // Arrange: Create some users
        $user = User::factory()->create();

        // Act: Make request
        $response = $this->getJson('/api/v1/user');

        // Assert: Assert that user data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $user->name]);
    }

    // test to see if the user can be created
    public function test_can_create_user()
    {
        // Arrange: Prepare data
        $data = [
            'name' => 'Test name',
            'email' => 'test@test.com',
            'password' => 'Test password',
            'phone' => 'Test phone',
            'address' => 'Test address',
            'city' => 'Test city',
            'state' => 'Test state',
            'zip' => 'Test zip',
            'country' => 'Test country',
            'latitude' => 'Test latitude',
            'longitude' => 'Test longitude',
            'comment' => 'Test comment',
            'ip_address' => '192.168.0.1',

        ];

        // Act: Make request
        $response = $this->postJson('/api/v1/user', $data);

        // Assert: Assert that user is created
        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Test name']);
        $this->assertDatabaseHas('users', ['name' => 'Test name']);
    }

    // test to see if the user can be shown
    public function test_can_show_user()
    {
        // Arrange: Create user
        $user = User::factory()->create();

        // Act: Make request
        $response = $this->getJson("/api/v1/user/{$user->id}");

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
        $response = $this->putJson("/api/v1/user/{$user->id}", [
            'name' => 'New Name',
            'email' => $user->email,
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
        $response = $this->deleteJson("/api/v1/user/{$user->id}");

        // Assert: Assert that user is deleted
        $response->assertStatus(204);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}