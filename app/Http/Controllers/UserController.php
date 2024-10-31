<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function borrowBook()
    {
        return view('user.borrow_status');
    }

    public function borrowList()
    {
        $temp_list = array(
            [
                'title' => 'the lord of the rings',
                'author' => 'j.r.r. tolkien',
                'borrowed at' => '2021-01-01',
                'returned at' => '2021-01-15',
            ],
            [
                'title' => 'the hobbit',
                'author' => 'also j.r.r. tolkien',
                'borrowed at' => '2021-01-01',
                'returned at' => '2021-01-15',
            ],
            [
                'title' => 'the silmarillion',
                'author' => 'nope, still j.r.r. tolkien',
                'borrowed at' => '2021-01-01',
                'returned at' => '2021-01-15',
            ],
        );

        foreach ($temp_list as $key => $value) {
            $temp_list[$key]['title'] = ucwords($value['title']);
        }


        return view('user.borrow_list', ['books' => $temp_list]);
    }
}
