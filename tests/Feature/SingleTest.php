<?php

namespace Tests\Feature;

use App\Models\Single;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingleTest extends TestCase
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
    public function single_create_api()
    {
        $response = $this->postJson(route('singles.store'), [
            'title' => 'New Single',
            'slug' => 'new-single',
            'image' => 'image.jpg',
            'body' => 'Single description',
            'accordions' => [
                [
                    'title' => 'Accordion 1',
                    'content' => 'Content for accordion 1',
                ],
                [
                    'title' => 'Accordion 2',
                    'content' => 'Content for accordion 2',
                ],
            ],
        ], $this->headers);

        $response->assertStatus(201);

        $this->assertDatabaseHas('singles', [
            'title' => 'New Single',
            'slug' => 'new-single',
            'image' => 'image.jpg',
            'body' => 'Single description',
        ]);
    }

    /** @test */
    public function single_list_api()
    {
        Single::factory()->count(3)->create();

        $response = $this->get(route('singles.index'), $this->headers);

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function single_update_api()
    {
        $single = Single::factory()->create([
            'title' => 'Old Title',
            'slug' => 'old-title',
            'image' => 'old_image.jpg',
            'body' => 'Old description',
            'accordions' => [
                [
                    'title' => 'Old Accordion 1',
                    'content' => 'Old content for accordion 1',
                ],
            ],
        ]);

        $response = $this->put(route('singles.update', $single), [
            'title' => 'Updated Title',
            'slug' => 'updated-title',
            'image' => 'updated_image.jpg',
            'body' => 'Updated description',
            'accordions' => [
                [
                    'title' => 'Updated Accordion 1',
                    'content' => 'Updated content for accordion 1',
                ],
                [
                    'title' => 'Updated Accordion 2',
                    'content' => 'Updated content for accordion 2',
                ],
            ],
        ], $this->headers);

        $response->assertStatus(200);
        $this->assertDatabaseHas('singles', [
            'id' => $single->id,
            'title' => 'Updated Title',
            'slug' => 'updated-title',
            'image' => 'updated_image.jpg',
            'body' => 'Updated description',
        ]);
    }

    /** @test */
    public function single_delete_api()
    {
        $single = Single::factory()->create();

        $response = $this->delete(route('singles.destroy', $single), [], $this->headers);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('singles', [
            'id' => $single->id,
        ]);
    }
}
