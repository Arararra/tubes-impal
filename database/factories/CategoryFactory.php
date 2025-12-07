<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Category::class;
    
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(2, true),
            'image' => 'image-' . $this->faker->numberBetween(1, 10) . '.jpg',
        ];
    }
}
