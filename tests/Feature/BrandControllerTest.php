<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllBrands()
    {
        $response = $this->getJson('/api/v1/brand');
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name']
            ]);
    }
    public function test_can_retrieve_brands()
    {
        // Arrange: Create some brands
        $brand = Brand::factory()->create();

        // Act: Make request
        $response = $this->getJson('/api/v1/brand');

        // Assert: Assert that brand data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $brand->name]);
    }

    public function test_can_create_brand()
    {
        // Arrange: Prepare data
        $data = [
            'name' => 'New Brand'
        ];

        // Act: Make request
        $response = $this->postJson('/api/v1/brand', $data);

        // Assert: Assert that brand is created
        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Brand']);
        $this->assertDatabaseHas('brands', ['name' => 'New Brand']);
    }

    public function test_can_show_brand()
    {
        // Arrange: Create brand
        $brand = Brand::factory()->create();

        // Act: Make request
        $response = $this->getJson("/api/v1/brand/{$brand->id}");

        // Assert: Assert that brand data is seen
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $brand->name]);
    }

    public function test_can_update_brand()
    {
        // Arrange: Create brand
        $brand = Brand::factory()->create();

        // Act: Update brand
        $response = $this->putJson("/api/v1/brand/{$brand->id}", ['name' => 'Updated Brand']);

        // Assert: Assert that brand is updated
        $response->assertStatus(200);
        $this->assertDatabaseHas('brands', ['name' => 'Updated Brand']);
    }

    public function test_can_delete_brand()
    {
        // Arrange: Create brand
        $brand = Brand::factory()->create();

        // Act: Delete brand
        $response = $this->deleteJson("/api/v1/brand/{$brand->id}");

        // Assert: Assert that brand is deleted
        dump($response);
        $response->assertStatus(204);

        $this->assertDatabaseMissing('brands', ['id' => $brand->id]);
    }
}
