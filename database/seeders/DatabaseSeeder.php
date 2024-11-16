<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Pulisher;
use App\Models\BookCopies;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Author::factory(13)->create();
        Category::factory(10)->create();
        Pulisher::factory(20)->create();
        Book::factory(100)->create();

        $books = Book::all();

        foreach ($books as $book) {
            $copies = [];
            $totalCopies = $book->quantity;
            $borrowedCount = $book->borrowed_copies;

            for ($i = 1; $i <= $totalCopies; $i++) {
                $copies[] = [
                    'book_id' => $book->book_Id,
                    'copy_number' => $i,
                    'status' => $i <= $borrowedCount ? 'borrowed' : 'available',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            BookCopies::insert($copies);
        }
    }
}