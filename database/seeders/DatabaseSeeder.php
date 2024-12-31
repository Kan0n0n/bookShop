<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Pulisher;
use App\Models\BookCopies;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Pulisher::factory(10)->create();


        $csv = Reader::createFromPath(database_path('seeders/cleaned_books.csv'), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        $count = 0;

        foreach ($records as $record) {
            $author = Author::firstOrCreate([
                'name' => $record['authors'],
            ]);

            $pulisher_id = rand(1, 10);
            $quantity = rand(1, 50);

            $pages = intval($record['num_pages']);
            if(!$pages || $pages < 1) {
                $pages = rand(100, 500);
            }

            $book = Book::firstOrCreate([
                'title' => $record['title'],
                'description' => $record['description'],
                'book_cover_image_path' => $record['image_path'],
                'isbn' => $record['isbn10'],
                'pages' => $pages,
                'quantity' => $quantity,
                'borrowed_copies' => 0,
                'author_id' => $author->author_Id,
                'pulisher_Id' => $pulisher_id,
                'language' => "English",
            ]);

            $categories = explode(',', $record['categories']);
            foreach ($categories as $category) {
                $category = Category::firstOrCreate([
                    'name' => $category,
                ]);
                $book->categories()->attach($category->category_Id);
            }

            for ($i = 0; $i < $quantity; $i++) {
                BookCopies::create([
                    'book_Id' => $book->book_Id,
                    'copy_number' => $i + 1,
                    'status' => 'available',
                ]);
            }

            $count++;
            if ($count >= 500) {
                break;
            }
        }
    }
}
