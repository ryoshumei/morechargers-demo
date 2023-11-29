<?php

namespace Tests\Feature;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class FeedbackControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // authenticate the user with Sanctum
        // create a user
        $user = User::factory()->create();

        // authenticate the user with Sanctum
        Sanctum::actingAs($user, ['*']);
        // Create seed data
        $this->seed();
    }

    public function test_can_retrieve_feedback()
    {
        // Arrange: Create some feedback
        $feedback = Feedback::factory()->create();
        dump($feedback);
        // Act: Make request
        $response = $this->getJson('/api/v1/feedback');

        // Assert: Assert that feedback data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['text' => $feedback->text]);
    }

    public function test_can_create_feedback()
    {
        // Arrange: Prepare data
        $data = [
            'email' => 'test@test.com',
            'text' => 'Test text',
            ];

        // Act: Make request
        $response = $this->postJson('/api/v1/feedback', $data);

        // Assert: Assert that feedback is created
        $response->assertStatus(201)
            ->assertJsonFragment(['text' => 'Test text']);
        $this->assertDatabaseHas('feedback', ['text' => 'Test text']);
    }

    public function test_can_show_feedback()
    {
        // Arrange: Create feedback
        $feedback = Feedback::factory()->create();

        // Act: Make request
        $response = $this->getJson("/api/v1/feedback/{$feedback->id}");

        // Assert: Assert that feedback data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['text' => $feedback->text]);
    }

    public function test_can_update_feedback()
    {
        // Arrange: Create feedback
        $feedback = Feedback::factory()->create();

        // Act: Update feedback
        $response = $this->putJson("/api/v1/feedback/{$feedback->id}", ['text' => 'New Text']);

        // Assert: Assert that feedback is updated
        $response->assertStatus(200)
            ->assertJsonFragment(['text' => 'New Text']);
        $this->assertDatabaseHas('feedback', ['text' => 'New Text']);
    }

    public function test_can_delete_feedback()
    {
        // Arrange: Create feedback
        $feedback = Feedback::factory()->create();

        // Act: Delete feedback
        $response = $this->deleteJson("/api/v1/feedback/{$feedback->id}");

        // Assert: Assert that feedback is deleted
        $response->assertStatus(204);
        $this->assertDatabaseMissing('feedback', ['id' => $feedback->id]);
    }




}
