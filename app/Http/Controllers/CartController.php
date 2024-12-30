<?php

namespace App\Http\Controllers;

use App\Models\Cart_Item;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCopies;
use App\Models\Cart;
use App\Models\BorrowBook;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    //
    public function add(Request $request)
    {
        try
        {
            $check = Cart::where("user_id", $request->user_id)->where("status", "onActive")->whereNotNull("checkout_date")->first();
            if($check != null)
            {
                return redirect()->back()->with("error", "You have an active cart. Please go get these books first before adding more");
            }

            $cart = Cart::firstOrCreate([
                "user_id" => $request->user_id,
                "status" => "onActive",
                "checkout_date" => null,
            ]);

            Log::info("cart_create". $cart->items);

            if(count($cart->items) == 5)
            {
                Log::info("cart full", ["cart is full"]);
                return redirect()->back()->with("error", "You can only add 5 items to cart");
            }
            else
            {
                foreach($cart->items as $item)
                {
                    if($item->book_copy->book->book_Id == $request->book_id)
                    {
                        Log::info("book already in cart");
                        return redirect()->back()->with("error", "Book already in cart");
                    }
                }
                $borrowed_books = BorrowBook::where("user_id", $request->user_id)->whereNot("status", "returned")->get();
                foreach($borrowed_books as $borrowed_book)
                {
                    if($borrowed_book->book_id == $request->book_id)
                    {
                        Log::info("book already borrowed");
                        return redirect()->back()->with("error", "Book already borrowed");
                    }
                }
                $book_copy = BookCopies::where("book_Id", $request->book_id)->where("status", "available")->first();

                if($book_copy == null)
                {
                    Log::info("no copy available");
                    return redirect()->back()->with("error", "No copy available");
                }

                BookCopies::where("book_Id", $request->book_id)->where("status", "available")->first()->update([
                    "status" => "reserved"
                ]);

                Book::where("book_Id", $request->book_id)->update([
                    "borrowed_copies" => Book::where("book_Id", $request->book_id)->first()->borrowed_copies + 1
                ]);

                $cart_item = Cart_Item::create([
                    "book_copy_id" => $book_copy->id,
                    "cart_id" => $cart->id
                ]);

                $cart_item->save();

                Log::info("Add book complete");
                return redirect()->back()->with("success", "Book added to cart");
            }
        }
        catch (\Exception $e)
        {
            Log::error("Error". $e->getMessage());
            return redirect()->back()->with("error", "Something went wrong");
        }
    }

    public function remove(Request $request)
    {
        try {
            $cart_item = Cart_Item::find($request->id);
            $book_copy = BookCopies::find($cart_item->book_copy_id);
            $book_copy->status = "available";
            $book_copy->save();
            $book = Book::find($book_copy->book_Id);
            $book->borrowed_copies = $book->borrowed_copies - 1;
            $book->save();
            $cart_item->delete();
            Log::info("Remove book complete");
            return redirect()->back()->with("success","Book removed from cart");
        }
        catch (\Exception $e)
        {
            Log::error("Error". $e->getMessage());
            return redirect()->back()->with("error", "Something went wrong");
        }
    }

    public function checkoutPage($id)
    {
        try
        {
            $cart = Cart::find($id);

            if($cart == null)
            {
                Log::info("Cart not found");
                return redirect()->route('index');
            }
            if($cart->items == null || count($cart->items) == 0)
            {
                Log::info("Cart is empty");
                return redirect()->route('index');
            }
            if($cart->checkout_date != null)
            {
                Log::info("Cart already checked out");
                return redirect()->route('index');
            }

            return view("user.checkout");
        }
        catch (\Exception $e)
        {
            Log::error("Error". $e->getMessage());
            return redirect()->back()->with("error", "Something went wrong");
        }
    }

    public function checkout(Request $request)
    {
        try
        {
            $cart = Cart::find($request->cart_id);
            $cart->checkout_date = $request->pickup_date;
            $cart->note = $request->notes;
            $cart->save();
            Log::info("Checkout complete");
            return redirect()->route('index')->with("success", "Checkout complete");
        }
        catch (\Exception $e)
        {
            Log::error("Error". $e->getMessage());
            return redirect()->back()->with("error", "Something went wrong");
        }
    }
}
