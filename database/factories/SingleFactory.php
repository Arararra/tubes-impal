<?php

namespace Database\Factories;

use App\Models\Single;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Single>
 */
class SingleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Single::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'slug' => $this->faker->slug(),
            'image' => 'image-' . $this->faker->numberBetween(1, 10) . '.jpg',
            'body' => $this->faker->paragraph(),
            'accordions' => [
                [
                    'title' => $this->faker->words(2, true),
                    'content' => $this->faker->paragraph(),
                ],
                [
                    'title' => $this->faker->words(2, true),
                    'content' => $this->faker->paragraph(),
                ],
            ],
        ];
    }
}
