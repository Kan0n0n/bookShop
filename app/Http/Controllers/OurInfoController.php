<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OurInfoController extends Controller
{
    public function about()
    {
        return view('our_info.about');
    }

    public function contact()
    {
        return view('our_info.contact');
    }
}