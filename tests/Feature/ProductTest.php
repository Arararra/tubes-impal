<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
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
    public function product_create_api()
    {
        $response = $this->postJson(route('products.store'), [
            'title' => 'New Product',
            'image' => "products/roti-gandum.jpg",
            'body' => 'Product description',
            'price' => 9999,
            'stock' => 10,
        ], $this->headers);

        $response->assertStatus(201);

        $this->assertDatabaseHas('products', [
            'title' => 'New Product',
            'image' => "products/roti-gandum.jpg",
            'body' => 'Product description',
            'price' => 9999,
            'stock' => 10,
        ]);
    }

    /** @test */
    public function product_list_api()
    {
        Product::factory()->count(3)->create();

        $response = $this->get(route('products.index'), $this->headers);

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function product_update_api()
    {
        $product = Product::factory()->create([
            'title' => 'Old Title',
            'image' => 'old_image.jpg',
            'body' => 'Old description',
            'price' => 50.00,
            'stock' => 5,
        ]);

        $response = $this->put(route('products.update', $product), [
            'title' => 'Updated Title',
            'image' => 'updated_image.jpg',
            'body' => 'Updated description',
            'price' => 150.00,
            'stock' => 15,
        ], $this->headers);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'title' => 'Updated Title',
            'image' => 'updated_image.jpg',
            'body' => 'Updated description',
            'price' => 150.00,
            'stock' => 15,
        ]);
    }

    /** @test */
    public function product_delete_api()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product), [], $this->headers);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
