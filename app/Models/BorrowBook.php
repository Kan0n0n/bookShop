<?php

namespace App\Models;

use App\Models\Book;
use App\Models\BookCopies;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowBook extends Model
{
    //
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = [
        "user_id",
        "book_id",
        "book_copy_id",
        "borrow_date",
        "return_date",
        "status",
        "cart_id",
        "due_date",
    ];

    protected $casts = [
        "status"=> "string",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function book_copy()
    {
        return $this->belongsTo(BookCopies::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
