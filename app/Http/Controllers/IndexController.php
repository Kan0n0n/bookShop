<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
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
