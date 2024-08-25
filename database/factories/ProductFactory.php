<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word,
            'desc' => fake()->sentence,
            'price' => fake()->numberBetween(1,1000),
            'user_id' => fake()->numberBetween(1,6),
            'category_id' => fake()->numberBetween(1,8),
            'category_name' => fake()->word(),
        ];
    }
}
