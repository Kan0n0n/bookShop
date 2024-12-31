<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create(Request $request)
    {
        $perPage = $request->input('per_page', 15);

        $query = Book::with(['author', 'categories']);
        $books = $query->paginate($perPage);

        //DB::enableQueryLog();
        //dd($books->first() , DB::getQueryLog());

        $categories = Category::all();
        return view('books.explore', ['books' => $books, 'categories' => $categories, 'perPage' => $perPage]);
    }

    public function search(Request $request)
    {
        try
        {
            Log::info('Search request', ['request' => $request->all()]);

            $query = Book::with(['author', 'categories']);

            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'like', "%{$searchTerm}%")->orWhereHas('author', function ($subq) use ($searchTerm) {
                        $subq->where('name', 'like', "%{$searchTerm}%");
                    });
                });
            }

            if ($request->has('categories')) {
                $categories = $request->input('categories');
                if (is_array($categories)) {
                    $query->whereHas('categories', function ($q) use ($categories) {
                        $q->whereIn('categories.category_Id', $categories);
                    });
                }
            }

            switch ($request->input('sort')) {
                case 'newest':
                    $query->orderBy('published_date', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('published_date', 'asc');
                    break;
                default:
                    $query->orderBy('title');
                    break;
            }

            // $books = $query->paginate($request->input('per_page', 15));

            $books = $query->get();
            $books = $query->paginate($request->input('per_page', 15));

            if ($request->ajax()) {
                Log::info('Returning search results', ['books' => $books]);
                return view('components.book_list', compact('books'))->render();
            }
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
}

    public function show($id, Request $request)
    {
        $book = Book::findOrFail($id);
        $dueDate = now()->addWeeks(2)->format('D, M d, Y');

        $language = $book->language;
        $bookRecommendations = Book::where('book_Id', '!=', $book->book_Id)->inRandomOrder()->limit(5)->get();
        $reviews = Review::where('book_Id', $book->book_Id)->paginate(5);
        $user_review = Review::where('book_Id', $book->book_Id)->where('user_Id', auth()->id())->first();

        if ($request->ajax()) {
            return view('components.review-list', compact('reviews'))->render();
        }

        return view('books.show', compact('book','dueDate','language','bookRecommendations','reviews', 'user_review'))->render();
    }

    public function languageConvert($language)
    {
        $languages = [
            'en' => 'English',
            'fr' => 'French',
            'es' => 'Spanish',
            'de' => 'German',
            'vi' => 'Vietnamese',
            'zh' => 'Chinese',
            'ja' => 'Japanese',
            'ko' => 'Korean',
            'it' => 'Italian',
            'pt' => 'Portuguese',
            'ru' => 'Russian',
            'ar' => 'Arabic',
            'hi' => 'Hindi',
            'ik' => 'Inuktitut',
            'uk' => 'Ukrainian',
        ];

        return $languages[$language] ?? 'Unknown';
    }
}
