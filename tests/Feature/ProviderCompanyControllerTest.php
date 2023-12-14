<?php

namespace Tests\Feature;

use App\Models\ProviderCompany;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProviderCompanyControllerTest extends TestCase
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

    //test to see if the provider company can be retrieved
    public function test_can_retrieve_provider_companies()
    {
        // Arrange: Create some provider companies
        $providerCompany = ProviderCompany::factory()->create();

        // Act: Make request
        $response = $this->getJson('/api/v1/public/provider-company');

        // Assert: Assert that provider company data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $providerCompany->name]);
    }

    //test to see if the provider company can be created
//    public function test_can_create_provider_company()
//    {
//        // Arrange: Prepare data
//        $data = [
//            'name' => 'Test name',
//            'description' => 'Test description',
//            'website' => 'Test website',
//            'logo' => 'Test logo',
//            'phone' => 'Test phone',
//            'email' => 'Test email',
//            'address' => 'Test address',
//            'city' => 'Test city',
//            'state' => 'Test state',
//            'zip' => 'Test zip',
//            'country' => 'Test country',
//            'latitude' => 'Test latitude',
//            'longitude' => 'Test longitude',
//            'comment' => 'Test comment',
//        ];
//
//        // Act: Make request
//        $response = $this->postJson('/api/v1/provider-company', $data);
//
//        // Assert: Assert that provider company is created
//        $response->assertStatus(201)
//            ->assertJsonFragment(['name' => 'Test name']);
//        $this->assertDatabaseHas('provider_companies', ['name' => 'Test name']);
//    }

    //test to see if the provider company can be shown
//    public function test_can_show_provider_company()
//    {
//        // Arrange: Create provider company
//        $providerCompany = ProviderCompany::factory()->create();
//
//        // Act: Make request
//        $response = $this->getJson("/api/v1/provider-company/{$providerCompany->id}");
//
//        // Assert: Assert that provider company data is seen
//        $response->assertStatus(200)
//            ->assertJsonFragment(['name' => $providerCompany->name]);
//    }

    //test to see if the provider company can be updated
//    public function test_can_update_provider_company()
//    {
//        // Arrange: Create provider company
//        $providerCompany = ProviderCompany::factory()->create();
//
//        // Act: Update provider company
//        $response = $this->putJson("/api/v1/provider-company/{$providerCompany->id}", ['name' => 'New Name']);
//
//        // Assert: Assert that provider company is updated
//        $response->assertStatus(200)
//            ->assertJsonFragment(['name' => 'New Name']);
//        $this->assertDatabaseHas('provider_companies', ['name' => 'New Name']);
//    }

    //test to see if the provider company can be deleted
//    public function test_can_delete_provider_company()
//    {
//        // Arrange: Create provider company
//        $providerCompany = ProviderCompany::factory()->create();
//
//        // Act: Delete provider company
//        $response = $this->deleteJson("/api/v1/provider-company/{$providerCompany->id}");
//
//        // Assert: Assert that provider company is deleted
//        $response->assertStatus(204);
//        $this->assertDatabaseMissing('provider_companies', ['id' => $providerCompany->id]);
//    }
}
