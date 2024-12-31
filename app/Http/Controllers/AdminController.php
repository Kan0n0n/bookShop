<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Pulisher;
use App\Models\Category;
use App\Models\BookCopies;
use App\Models\User;
use App\Models\Cart;
use App\Models\BorrowBook;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {

        if(Auth::user() && Auth::user()->role == true)
        {
            $totalBooks = Book::all()->count();
            $totalUsers = User::all()->count();
            $activeBorrows = BorrowBook::where('status', 'borrowed')->count();
            $totalRevenue = number_format(User::where('active_status', 'active')->count() * 50000, 0, ',', '.') . ' VNĐ';

            $borrowers = BorrowBook::all();
            $topBorrowers = BorrowBook::select('user_id', BorrowBook::raw('count(*) as total_borrows'))
            ->with('user')
            ->groupBy('user_id')
            ->orderBy('total_borrows', 'desc')
            ->take(5)
            ->get();

            $popularBooks = BorrowBook::select('book_id')
            ->with('book_copy.book')
            ->selectRaw('COUNT(*) as borrow_count')
            ->groupBy('book_id')
            ->orderBy('borrow_count', 'desc')
            ->take(5)
            ->get()
            ->map(function($borrow) {
                return [
                    'book_image' => Book::find($borrow->book_id)->book_cover_image_path,
                    'title' => Book::find($borrow->book_id)->title,
                    'author' => Book::find($borrow->book_id)->author->name,
                    'borrow_count' => $borrow->borrow_count
                ];
            });

            $recentActivities = BorrowBook::with(['user', 'book'])
                ->latest()
                ->take(5)
                ->get();

            return view('Dashboard.index', compact(
                'totalBooks',
                'totalUsers',
                'activeBorrows',
                'totalRevenue',
                'topBorrowers',
                'popularBooks',
                'recentActivities'
            ));
        }
        else
        {
            return redirect()->route('index');
        }
    }

    public function book()
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        $books = Book::all();
        $authors = Author::all();
        $publishers = Pulisher::all();
        $categories = Category::all();
        return view('Dashboard.books', compact('books', 'authors', 'publishers', 'categories'));
    }

    public function createBook(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            log::info('Validating request');
            log::info($request->all());

            $request->validate([
                'title' => 'required|string|max:255',
                'isbn' => 'required|string|max:255',
                'author_id' => 'required|integer',
                'publisher_id' => 'required|integer',
                'description' => 'required|string',
                'pages' => 'required|integer',
                'quantity' => 'required|integer',
                'released_date' => 'required|date',
                'language' => 'required|string',
                'categories' => 'required|array',
                'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            log::info('Validation passed');

            $cover = $request->file('cover_image');
            $coverName = time() . '.' . $cover->extension();
            $cover->move(public_path('images/bookCover'), $coverName);
            $coverPath = 'images/bookCover/' . $coverName;

            $book = new Book();
            $book->title = $request->title;
            $book->isbn = $request->isbn;
            $book->author_Id = $request->author_id;
            log::info($book->author_Id);
            $book->pulisher_Id = $request->publisher_id;
            log::info($book->pulisher_Id);

            $book->description = $request->description;
            $book->pages = $request->pages;
            $book->quantity = $request->quantity;
            $book->borrowed_copies = 0;
            $book->released_date = $request->released_date;
            $book->published_date = now();
            $book->language = $request->language;
            $book->book_cover_image_path = $coverPath;
            $book->save();
            foreach ($request->categories as $category_id)
            {
                $category = Category::find($category_id);
                $book->categories()->attach($category);
            }
            log::info($book->categories);

            for ($i = 0; $i < $request->quantity; $i++)
            {
                $copy = new BookCopies();
                $copy->book_Id = $book->book_Id;
                $copy->copy_number = $i + 1;
                $copy->status = 'available';
                $copy->save();
            }

            return redirect()->back()->with('success', 'Book added successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateBook(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $updateBook = Book::find($request->book_id);
            log::info($request->all());

            if($updateBook == null)
            {
                return redirect()->back()->with('error', 'Book not found');
            }

            $data = array();
            if(!empty($request->title))
            {
                $data['title'] = $request->title;
            }
            if(!empty($request->isbn))
            {
                $data['isbn'] = $request->isbn;
            }
            if($request->author_id != null)
            {
                $data['author_id'] = $request->author_id;
            }
            if($request->publisher_id != null)
            {
                $data['publisher_id'] = $request->publisher_id;
            }
            if(!empty($request->description))
            {
                $data['description'] = $request->description;
            }
            if($request->pages != null)
            {
                $data['pages'] = $request->pages;
            }
            if($request->quantity != null)
            {
                $data['quantity'] = $request->quantity;
                if($request->quantity > $updateBook->quantity)
                {
                    for ($i = $updateBook->quantity; $i < $request->quantity; $i++)
                    {
                        $copy = new BookCopies();
                        $copy->book_Id = $updateBook->book_Id;
                        $copy->copy_number = $i + 1;
                        $copy->status = 'available';
                        $copy->save();
                    }
                }
                else if($request->quantity < $updateBook->quantity)
                {
                    $copies = BookCopies::where([
                        ['book_Id', '=', $updateBook->book_Id],
                        ['status', '=', 'available'],
                    ])->get();
                    if($copies->count() < $updateBook->quantity - $request->quantity)
                    {
                        return redirect()->back()->with('error', 'Cannot reduce quantity. There are borrowed copies');
                    }
                    $copies = $copies->sortBy('copy_number');
                    $copies = $copies->slice($request->quantity);
                    foreach ($copies as $copy)
                    {
                        $copy->delete();
                    }
                }
            }
            if($request->released_date != null)
            {
                $data['released_date'] = $request->released_date;
            }
            if(!empty($request->language))
            {
                $data['language'] = $request->language;
            }
            if($request->hasFile('cover_image'))
            {
                $cover = $request->file('cover_image');
                $coverName = time() . '.' . $cover->extension();
                $cover->move(public_path('images/bookCover'), $coverName);
                $coverPath = 'images/bookCover/' . $coverName;
                $data['book_cover_image_path'] = $coverPath;
            }
            if($request->has('categories'))
            {
                $updateBook->categories()->detach();
                foreach ($request->categories as $category_id)
                {
                    $category = Category::find($category_id);
                    $updateBook->categories()->attach($category);
                }
            }
            else
            {
                return redirect()->back()->with('error', 'Categories are required');
            }
            $updateBook->update($data);
            return redirect()->back()->with('success', 'Book updated successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteBook(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $deleteBook = Book::find($request->book_id);
            if($deleteBook == null)
            {
                return redirect()->back()->with('error', 'Book not found');
            }
            if($deleteBook->copies()->where('status', 'borrowed')->count() > 0)
            {
                log::info($deleteBook->copies()->where('status', 'borrowed')->count());
                log::info($deleteBook->copies()->where('status', 'borrowed')->get());
                return redirect()->back()->with('error', 'Cannot delete book. There are borrowed copies');
            }
            $deleteBook->categories()->detach();
            $deleteBook->copies()->delete();
            $deleteBook->delete();
            return redirect()->back()->with('success', 'Book deleted successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // author
    public function author()
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        $authors = Author::all();
        return view('Dashboard.authors', compact('authors'));
    }

    public function createAuthor(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $author = new Author();
            $author->name = $request->name;
            $author->save();
            return redirect()->back()->with('success', 'Author added successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateAuthor(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $updateAuthor = Author::find($request->author_id);
            if($updateAuthor == null)
            {
                return redirect()->back()->with('error', 'Author not found');
            }
            $data = array();
            if(!empty($request->name))
            {
                $data['name'] = $request->name;
            }
            $updateAuthor->update($data);
            return redirect()->back()->with('success', 'Author updated successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteAuthor(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $deleteAuthor = Author::find($request->author_id);
            if($deleteAuthor == null)
            {
                return redirect()->back()->with('error', 'Author not found');
            }
            if($deleteAuthor->books()->count() > 0)
            {
                return redirect()->back()->with('error', 'Cannot delete author. There are books associated with this author');
            }
            $deleteAuthor->delete();
            return redirect()->back()->with('success', 'Author deleted successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // publisher
    public function publisher()
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        $publishers = Pulisher::all();
        return view('Dashboard.publishers', compact('publishers'));
    }

    public function createPublisher(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:11',
            ]);

            $publisher = new Pulisher();
            $publisher->name = $request->name;
            $publisher->address = $request->address;
            $publisher->phone = $request->phone;
            $publisher->save();
            return redirect()->back()->with('success', 'Publisher added successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updatePublisher(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $updatePublisher = Pulisher::find($request->publisher_id);
            if($updatePublisher == null)
            {
                return redirect()->back()->with('error', 'Publisher not found');
            }
            $data = array();
            if(!empty($request->name))
            {
                $data['name'] = $request->name;
            }
            if(!empty($request->address))
            {
                $data['address'] = $request->address;
            }
            if(!empty($request->phone))
            {
                $data['phone'] = $request->phone;
            }
            $updatePublisher->update($data);
            return redirect()->back()->with('success', 'Publisher updated successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deletePublisher(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $deletePublisher = Pulisher::find($request->publisher_id);
            if($deletePublisher == null)
            {
                return redirect()->back()->with('error', 'Publisher not found');
            }
            if($deletePublisher->books()->count() > 0)
            {
                return redirect()->back()->with('error', 'Cannot delete publisher. There are books associated with this publisher');
            }
            $deletePublisher->delete();
            return redirect()->back()->with('success', 'Publisher deleted successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // category
    public function category()
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        $categories = Category::all();
        return view('Dashboard.categories', compact('categories'));
    }

    public function createCategory(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $category = new Category();
            $category->name = $request->name;
            $category->category_Description = $request->description;
            $category->save();
            return redirect()->back()->with('success', 'Category added successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateCategory(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $updateCategory = Category::find($request->category_id);
            if($updateCategory == null)
            {
                return redirect()->back()->with('error', 'Category not found');
            }
            $data = array();
            if(!empty($request->name))
            {
                $data['name'] = $request->name;
            }
            if(!empty($request->description))
            {
                $data['category_Description'] = $request->description;
            }
            $updateCategory->update($data);
            return redirect()->back()->with('success', 'Category updated successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteCategory(Request $request)
    {

        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $deleteCategory = Category::find($request->category_id);
            if($deleteCategory == null)
            {
                return redirect()->back()->with('error', 'Category not found');
            }
            if($deleteCategory->books()->count() > 0)
            {
                return redirect()->back()->with('error', 'Cannot delete category. There are books associated with this category');
            }
            $deleteCategory->delete();
            return redirect()->back()->with('success', 'Category deleted successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // user
    public function user()
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        $users = User::all();
        return view('Dashboard.users', compact('users'));
    }

    public function createUser(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'phone' => 'required|string|max:11',
                'address' => 'required|string',
                'gerne' => 'required|string',
                'date_of_birth' => 'required|date',
                'role' => 'required|string',
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->gerne = $request->gerne;
            $user->date_of_birth = $request->date_of_birth;
            if($request->role == 'admin')
            {
                $user->role = true;
            }
            else
            {
                $user->role = false;
            }
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->extension();
            $avatar->move(public_path('images/avatar'), $avatarName);
            $avatarPath = 'images/avatar/' . $avatarName;
            $user->avatar_path = $avatarPath;
            $user->save();
            return redirect()->back()->with('success', 'User added successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteUser(Request $request)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $deleteUser = User::find($request->user_id);
            if($deleteUser == null)
            {
                return redirect()->back()->with('error', 'User not found');
            }

            if($deleteUser->status == false)
            {
                $deleteUser->status = true;
                $deleteUser->save();

                return redirect()->back()->with('success', 'User unblock successfully');
            }
            else
            {
                $deleteUser->status = false;
                $deleteUser->save();

                return redirect()->back()->with('success', 'User block successfully');
            }


        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function cart()
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        $carts = Cart::where(function($query) {
        $query->where('status', 'onActive')
            ->whereNotNull('checkout_date');
        })
        ->orWhere('status', 'checkedOut')
        ->get();
        return view('Dashboard.carts', compact('carts'));
    }

    public function checkout($id)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $cart = Cart::find($id);
            if($cart == null)
            {
                return redirect()->back()->with('error', 'Cart not found');
            }
            foreach ($cart->items as $item)
            {
                $item->book_copy->status = 'borrowed';

                $checkout_date = now();
                $return_date = Carbon::parse($cart->checkout_date)->addDays(7);

                $borrow = new BorrowBook(
                    [
                        'user_id' => $cart->user_id,
                        'book_id' => $item->book_copy->book_Id,
                        'book_copy_id' => $item->book_copy_id,
                        'borrow_date' => $checkout_date,
                        'due_date' => $return_date,
                        'status' => 'borrowed',
                        'cart_id' => $cart->id,
                    ]
                );
                log::info($borrow);
                $item->book_copy->save();
                $borrow->save();
            }
            $cart->status = 'checkedOut';
            $cart->save();
            return redirect()->back()->with('success', 'Checkout completed successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function undoCheckout($id)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $cart = Cart::find($id);
            if($cart == null)
            {
                return redirect()->back()->with('error', 'Cart not found');
            }
            foreach ($cart->items as $item)
            {
                $item->book_copy->status = 'reserved';
                $borrow = BorrowBook::where([
                    ['user_id', '=', $cart->user_id],
                    ['book_id', '=', $item->book_copy->book_Id],
                    ['book_copy_id', '=', $item->book_copy_id],
                    ['status', '=', 'borrowed'],
                ])->first();
                $borrow->delete();
                $item->book_copy->save();
            }
            $cart->status = 'onActive';
            $cart->save();
            return redirect()->back()->with('success', 'Undo checkout completed successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function printCartReceipt($id)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $checkOutCart = Cart::find($id);

            if(!$checkOutCart) {
                return redirect()->back()->with('error', 'Cart not found');
            }

            $pdf = PDF::loadView('Dashboard.cart_receipt', compact('checkOutCart'));
            return $pdf->download('cart-receipt-'.$checkOutCart->id.'.pdf');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function borrowBookPage()
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        $borrowBooks = Cart::wherehas('borrowBooks')->get();
        BorrowBook::checkOverdue();
        return view('Dashboard.borrow_book', compact('borrowBooks'));
    }

    public function returnBook($id)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $borrow = BorrowBook::find($id);
            if($borrow == null)
            {
                return redirect()->back()->with('error', 'Borrow not found');
            }
            $borrow->book_copy->status = 'available';
            $borrow->book_copy->book->borrowed_copies -= 1;

            $borrow->status = 'returned';
            $borrow->return_date = now();
            $borrow->book_copy->save();
            $borrow->book_copy->book->save();
            $borrow->save();
            return redirect()->back()->with('success', 'Book returned successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function returnAllBook($id)
    {
        if(!Auth::user() || !Auth::user()->role == true)
            return redirect()->route('index');
        try
        {
            $cart = Cart::find($id);
            if($cart == null)
            {
                return redirect()->back()->with('error', 'Cart not found');
            }
            foreach ($cart->borrowBooks as $borrow)
            {
                $borrow->book_copy->status = 'available';
                $borrow->book_copy->book->borrowed_copies -= 1;
                $borrow->status = 'returned';
                $borrow->return_date = now();
                $borrow->book_copy->save();
                $borrow->book_copy->book->save();
                $borrow->save();
            }
            return redirect()->back()->with('success', 'All books returned successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
