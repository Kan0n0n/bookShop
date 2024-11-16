<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Author::class;
    public function definition(): array
    {
        $authorNames = [
            'Isaac Asimov',
            'J.K. Rowling',
            'Agatha Christie',
            'Stephen King',
            'Jane Austen',
            'Malcolm Gladwell',
            'Walter Isaacson',
            'Dale Carnegie',
            'David McCullough',
            'Dr. Seuss',
            'Fujiko F. Fujio',
            'Keigo Higashino',
            'Hijiki',
            'Hazuki Sakuraba',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($authorNames),
        ];
    }
}
