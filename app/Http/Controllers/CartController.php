<?php

namespace App\Http\Controllers;

use App\Models\Cart_Item;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCopies;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    //
    public function add(Request $request)
    {
        try
        {
            $cart = Cart::firstOrCreate([
                "user_id" => $request->user_id,
                "status" => "onActive",
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
}