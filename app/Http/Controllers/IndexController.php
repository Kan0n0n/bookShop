<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            if($user->email_verified_at == null){
                return redirect()->route('verification.notice')->with('error', 'Please verify your email first');
            }
        }
        $books = Book::all();

        if (count($books) <= 6) {
            return view('home.index', ['books' => $books]);
        } else {
            $get_books = array();
            for ($i = 0; $i < 6; $i++) {
                array_push($get_books, $books[$i]);
            }
            return view('home.index', ['books' => $get_books]);
        }
    }

    public function contact()
    {
        return view('contact');
    }
}
