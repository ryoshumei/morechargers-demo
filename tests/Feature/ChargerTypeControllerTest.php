<?php

namespace Tests\Feature;

use App\Models\ChargerType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChargerTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_retrieve_charger_types()
    {
        // Arrange: Create some charger_types
        $chargertype = ChargerType::factory()->create();

        // Act: Make request
        $response = $this->getJson('/api/v1/chargertype');

        // Assert: Assert that chargertype data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $chargertype->name]);
    }

    public function test_can_create_chargertype()
    {
        // Arrange: Prepare data
        $data = [
            'name' => 'New ChargerType'
        ];

        // Act: Make request
        $response = $this->postJson('/api/v1/chargertype', $data);

        // Assert: Assert that chargertype is created
        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New ChargerType']);
        $this->assertDatabaseHas('charger_types', ['name' => 'New ChargerType']);
    }

    public function test_can_show_chargertype()
    {
        // Arrange: Create chargertype
        $chargertype = ChargerType::factory()->create();

        // Act: Make request
        $response = $this->getJson("/api/v1/chargertype/{$chargertype->id}");

        // Assert: Assert that chargertype data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $chargertype->name]);
    }

    public function test_can_update_chargertype()
    {
        // Arrange: Create chargertype
        $chargertype = ChargerType::factory()->create();

        // Act: Update chargertype
        $response = $this->putJson("/api/v1/chargertype/{$chargertype->id}", ['name' => 'Updated ChargerType']);

        // Assert: Assert that chargertype is updated
        $response->assertStatus(200);
        $this->assertDatabaseHas('charger_types', ['name' => 'Updated ChargerType']);
    }

    public function test_can_delete_chargertype()
    {
        // Arrange: Create chargertype
        $chargertype = ChargerType::factory()->create();

        // Act: Delete chargertype
        $response = $this->deleteJson("/api/v1/chargertype/{$chargertype->id}");

        // Assert: Assert that chargertype is deleted
        $response->assertStatus(204);

        $this->assertDatabaseMissing('charger_types', ['id' => $chargertype->id]);
    }
}
