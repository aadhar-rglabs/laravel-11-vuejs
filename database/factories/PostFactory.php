<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->name(),
            'description' => fake()->realText($maxNbChars = 200, $indexSize = 2),
            'file' => fake()->imageUrl($width = 800, $height = 600, 'cats'),
        ];
    }
}
