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
        $categories = [
            ['name' => 'Science Fiction', 'description' => 'Books that explore futuristic concepts and advanced technology.'],
            ['name' => 'Fantasy', 'description' => 'Books that contain magical or supernatural elements.'],
            ['name' => 'Mystery', 'description' => 'Books that involve solving a crime or uncovering secrets.'],
            ['name' => 'Thriller', 'description' => 'Books that are designed to thrill and keep you on the edge of your seat.'],
            ['name' => 'Romance', 'description' => 'Books that focus on romantic relationships.'],
            ['name' => 'Non-Fiction', 'description' => 'Books that provide factual information on various topics.'],
            ['name' => 'Biography', 'description' => 'Books that tell the life stories of real people.'],
            ['name' => 'Self-Help', 'description' => 'Books that offer advice and strategies for personal improvement.'],
            ['name' => 'History', 'description' => 'Books that explore historical events and figures.'],
            ['name' => 'Children', 'description' => 'Books that are written for children and young readers.']
        ];

        $category = $this->faker->unique()->randomElement($categories);

        return [
            //
            "name"=> $category['name'],
            "category_Description"=> $category['description'],
        ];
    }
}