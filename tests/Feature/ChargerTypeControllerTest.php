<?php

namespace Tests\Feature;

use App\Models\ChargerType;
use App\Models\ProviderCompany;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ChargerTypeControllerTest extends TestCase
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
    }
    public function test_it_fetches_charger_types_by_company_id()
    {
        // Arrange
        $providerCompany = ProviderCompany::factory()->create();
        $chargerTypes = ChargerType::factory()->count(3)->create();
        $providerCompany->chargerTypes()->attach($chargerTypes);

        // Act
        $response = $this->getJson("/api/v1/public/charger-types/{$providerCompany->id}");

        // Assert
        $response->assertStatus(200);
        foreach ($chargerTypes as $chargerType) {
            $response->assertJsonFragment(['name' => $chargerType->name]);
        }
    }

    public function test_it_returns_not_found_when_company_does_not_exist()
    {
        // Act
        $response = $this->getJson("/api/v1/public/charger-types/9999");

        // Assert
        $response->assertStatus(404);
    }

    public function test_it_returns_empty_list_when_no_charger_types_for_company()
    {
        // Arrange
        $providerCompany = ProviderCompany::factory()->create();

        // Act
        $response = $this->getJson("/api/v1/public/charger-types/{$providerCompany->id}");

        // Assert
        $response->assertStatus(200);
        $response->assertJson([]);
    }
// not used currently
//    public function test_can_retrieve_charger_types()
//    {
//        // Arrange: Create some charger_types
//        $chargertype = ChargerType::factory()->create();
//
//        // Act: Make request
//        $response = $this->getJson('/api/v1/chargertype');
//
//        // Assert: Assert that chargertype data is seen
//        $response->assertStatus(200)
//            ->assertJsonFragment(['name' => $chargertype->name]);
//    }
//
//    public function test_can_create_chargertype()
//    {
//        // Arrange: Prepare data
//        $data = [
//            'name' => 'New ChargerType'
//        ];
//
//        // Act: Make request
//        $response = $this->postJson('/api/v1/chargertype', $data);
//
//        // Assert: Assert that chargertype is created
//        $response->assertStatus(201)
//            ->assertJsonFragment(['name' => 'New ChargerType']);
//        $this->assertDatabaseHas('charger_types', ['name' => 'New ChargerType']);
//    }
//
//    public function test_can_show_chargertype()
//    {
//        // Arrange: Create chargertype
//        $chargertype = ChargerType::factory()->create();
//
//        // Act: Make request
//        $response = $this->getJson("/api/v1/chargertype/{$chargertype->id}");
//
//        // Assert: Assert that chargertype data is seen
//        $response->assertStatus(200)
//            ->assertJsonFragment(['name' => $chargertype->name]);
//    }
//
//    public function test_can_update_chargertype()
//    {
//        // Arrange: Create chargertype
//        $chargertype = ChargerType::factory()->create();
//
//        // Act: Update chargertype
//        $response = $this->putJson("/api/v1/chargertype/{$chargertype->id}", ['name' => 'Updated ChargerType']);
//
//        // Assert: Assert that chargertype is updated
//        $response->assertStatus(200);
//        $this->assertDatabaseHas('charger_types', ['name' => 'Updated ChargerType']);
//    }
//
//    public function test_can_delete_chargertype()
//    {
//        // Arrange: Create chargertype
//        $chargertype = ChargerType::factory()->create();
//
//        // Act: Delete chargertype
//        $response = $this->deleteJson("/api/v1/chargertype/{$chargertype->id}");
//
//        // Assert: Assert that chargertype is deleted
//        $response->assertStatus(204);
//
//        $this->assertDatabaseMissing('charger_types', ['id' => $chargertype->id]);
//    }
}
