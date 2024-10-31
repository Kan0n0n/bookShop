<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view('books.explore');
    }

    public function search()
    {
        return view('books.search');
    }

    public function book()
    {
        return view('books.book');
    }
}