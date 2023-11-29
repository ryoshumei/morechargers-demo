<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\VehicleModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class VehicleModelControllerTest extends TestCase
{
    //set up the test
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

    //test to see if the vehicle model can be retrieved
    public function test_can_retrieve_vehicle_models()
    {
        // Arrange: Create some vehicle models
        $vehicleModel = VehicleModel::factory()->create();

        // Act: Make request
        $response = $this->getJson('/api/v1/vehicle-model');

        // Assert: Assert that vehicle model data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $vehicleModel->name]);
    }

    //test to see if the vehicle model can be created
    public function test_can_create_vehicle_model()
    {
        // get a brand_id from the database
        $brand_id = \App\Models\Brand::first()->id;
        // Arrange: Prepare data
        $data = [
            'name' => 'Test name',
            'description' => 'Test description',
            'brand_id' => $brand_id,
            'comment' => 'Test comment',
        ];

        // Act: Make request
        $response = $this->postJson('/api/v1/vehicle-model', $data);

        // Assert: Assert that vehicle model is created
        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Test name']);
    }

    //test to see if the vehicle model can be shown
    public function test_can_show_vehicle_model()
    {
        // Arrange: Create vehicle model
        $vehicleModel = VehicleModel::factory()->create();

        // Act: Make request
        $response = $this->getJson("/api/v1/vehicle-model/{$vehicleModel->id}");

        // Assert: Assert that vehicle model data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $vehicleModel->name]);
    }

    //test to see if the vehicle model can be updated
    public function test_can_update_vehicle_model()
    {
        // get a brand_id from the database
        $brand_id = \App\Models\Brand::first()->id;
        // Arrange: Create vehicle model
        $vehicleModel = VehicleModel::factory()->create();

        // Arrange: Prepare data
        $data = [
            'name' => 'Test name',
            'description' => 'Test description',
            'brand_id' => $brand_id,
            'comment' => 'Test comment',
        ];

        // Act: Make request
        $response = $this->putJson("/api/v1/vehicle-model/{$vehicleModel->id}", $data);

        // Assert: Assert that vehicle model is updated
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Test name']);
    }

    //test to see if the vehicle model can be deleted
    public function test_can_delete_vehicle_model()
    {
        // Arrange: Create vehicle model
        $vehicleModel = VehicleModel::factory()->create();

        // Act: Delete vehicle model
        $response = $this->deleteJson("/api/v1/vehicle-model/{$vehicleModel->id}");

        // Assert: Assert that vehicle model is deleted
        $response->assertStatus(204);
        $this->assertDatabaseMissing('vehicle_models', ['id' => $vehicleModel->id]);
    }
}
