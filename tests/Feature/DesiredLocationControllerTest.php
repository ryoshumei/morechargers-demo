<?php

namespace Tests\Feature;

use App\Models\DesiredLocation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DesiredLocationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Create seed data
        $this->seed();
    }

    public function test_can_retrieve_desired_locations()
    {
        // Arrange: Create some desired_locations
        $desiredLocation = DesiredLocation::factory()->create();

        // Act: Make request
        $response = $this->getJson('/api/v1/desired-location');

        // Assert: Assert that desired_location data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['latitude' => $desiredLocation->latitude]);
    }

    public function test_can_create_desired_location()
    {   // get charger_type_id from database
        $charger_type_id = \App\Models\ChargerType::first()->id;
        //get provider_company_id from database
        $provider_company_id = \App\Models\ProviderCompany::first()->id;
        // get model_id from database
        $model_id = \App\Models\VehicleModel::first()->id;
        // get brand_id from database
        $brand_id = \App\Models\Brand::first()->id;
        // get user_id from database
        $user_id = \App\Models\User::first()->id;
        // Arrange: Prepare data
        $data = [
            'latitude' => 1.0,
            'longitude' => 1.0,
            'hope_radius' => 10,
            'has_ev_car' => false,  // add default values for other fields
            'brand_id' => $brand_id,
            'model_id' => $model_id,
            'charger_type_id' => $charger_type_id,
            'provider_company_id' => $provider_company_id,
            'user_id' => $user_id,
            'comment' => 'Test comment',
        ];

        // Act: Make request
        $response = $this->postJson('/api/v1/desired-location', $data);

        // Assert: Assert that desired_location is created
        $response->assertStatus(201)
            ->assertJsonFragment(['latitude' => 1.0]);
        $this->assertDatabaseHas('desired_locations', ['latitude' => 1.0]);
    }

    public function test_can_show_desired_location()
    {
        // Arrange: Create desired_location
        $desiredLocation = DesiredLocation::factory()->create();

        // Act: Make request
        $response = $this->getJson("/api/v1/desired-location/{$desiredLocation->id}");

        // Assert: Assert that desired_location data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['latitude' => $desiredLocation->latitude]);
    }

    public function test_can_update_desired_location()
    {
        // Arrange: Create desired_location
        $desiredLocation = DesiredLocation::factory()->create();

        // Act: Update desired_location
        $response = $this->putJson("/api/v1/desired-location/{$desiredLocation->id}", [
            'latitude' => 2.0,
            'longitude' => 2.0,
        ]);

        // Assert: Assert that desired_location is updated
        $response->assertStatus(200)
            ->assertJsonFragment(['latitude' => 2.0]);
        $this->assertDatabaseHas('desired_locations', ['latitude' => 2.0]);
    }

    public function test_can_delete_desired_location()
    {
        // Arrange: Create desired_location
        $desiredLocation = DesiredLocation::factory()->create();
        // Act: Delete
        $response = $this->deleteJson("/api/v1/desired-location/{$desiredLocation->id}");
        // Assert: Assert that desired_location is deleted
        $response->assertStatus(204);
        $this->assertDatabaseMissing('desired_locations', ['id' => $desiredLocation->id]);
    }

}
