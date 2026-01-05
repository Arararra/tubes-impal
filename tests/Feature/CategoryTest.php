<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    
    private $headers;

    // Set Authorization header
    public function setUp(): void
    {
        parent::setUp();

        $this->headers = [
            'Authorization' => 'Bearer ' . config('api.bearer_token'),
            'Accept' => 'application/json',
        ];
    }

    /** @test */
    public function category_create_api()
    {
        $response = $this->postJson(route('categories.store'), [
            'title' => 'New Category',
            'image' => 'image.jpg',
        ], $this->headers);

        $response->assertStatus(201);

        $this->assertDatabaseHas('categories', [
            'title' => 'New Category',
            'image' => 'image.jpg',
        ]);
    }

    /** @test */
    public function category_list_api()
    {
        Category::factory()->count(3)->create();

        $response = $this->get(route('categories.index'), $this->headers);

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function category_update_api()
    {
        $category = Category::factory()->create([
            'title' => 'Old Title',
            'image' => 'old_image.jpg',
        ]);

        $response = $this->put(route('categories.update', $category), [
            'title' => 'Updated Title',
            'image' => 'updated_image.jpg',
        ], $this->headers);

        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'title' => 'Updated Title',
            'image' => 'updated_image.jpg',
        ]);
    }

    /** @test */
    public function category_delete_api()
    {
        $category = Category::factory()->create();

        $response = $this->delete(route('categories.destroy', $category), [], $this->headers);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    /** @test */
    public function category_api_handle_invalid_id()
    {
        $invalidCategoryId = 99999;

        // Disini uji dilakukan dengan metode delete, untuk edit hasilnya sama saja
        $response = $this->delete(route('categories.destroy', ['category' => $invalidCategoryId]), [], $this->headers);

        $response->assertStatus(404);
    }

    /** @test */
    public function category_api_handle_invalid_input()
    {
        $response = $this->postJson(route('categories.store'), [
            'title' => 'New Category',
            'image' => 12345, // Invalid format
        ], $this->headers);

        $response->assertStatus(422);
        
        $response->assertJsonValidationErrors(['image']);
    }
}
