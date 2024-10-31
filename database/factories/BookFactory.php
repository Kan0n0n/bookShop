<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(10),
            'author' => fake()->name(),
            'genre' => fake()->word(),
            'price' => fake()->numberBetween(100, 1000),
            'quantity' => fake()->numberBetween(1, 100),
            'description' => fake()->paragraph(3),
            'image' => fake()->imageUrl(),
        ];
    }
}
