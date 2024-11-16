<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Pulisher;
use App\Models\BookCopies;
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
    protected $model = Book::class;
    public function definition(): array
    {
        $bookCovers = glob(public_path('images/bookCovers/*.{jpg,jpeg,png,gif}'), GLOB_BRACE);

        $bookCovers = array_map(function($path) {
            return 'images/bookCovers/' . basename($path);
        }, $bookCovers);

        $randomQuantity = $this->faker->numberBetween(1, 10);
        $randomBorrowedCopies = $this->faker->numberBetween(0, $randomQuantity);

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'book_cover_image_path'=> $this->faker->randomElement($bookCovers),
            'isbn' => $this->faker->isbn13,
            'pages' => $this->faker->numberBetween(100, 1000),
            'quantity' => $randomQuantity,
            'borrowed_copies' => $randomBorrowedCopies,
            'released_date' => $this->faker->date(),
            'published_date'=> $this->faker->date(),
            'author_id' => $this->faker->randomElement(Author::pluck('author_Id')),
            'pulisher_Id' => $this->faker->randomElement(Pulisher::pluck('pulisher_Id')),
            'language'=> $this->faker->languageCode,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Book $book) {
            $categories = Category::inRandomOrder()->take(rand(1, 10))->pluck('category_Id');
            $book->categories()->attach($categories);
        });
    }
}