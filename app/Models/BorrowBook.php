<?php

namespace App\Models;

use App\Models\Book;
use App\Models\BookCopies;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_Id');
    }

    public function book_copy()
    {
        return $this->belongsTo(BookCopies::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    protected static function booted()
    {
        static::retrieved(function ($borrowBook) {
            if ($borrowBook->status === 'borrowed' &&
                $borrowBook->due_date < Carbon::now()) {
                $borrowBook->status = 'overdue';
                $borrowBook->save();
            }
        });
    }

    public static function checkOverdue()
    {
        return static::where('status', 'borrowed')
            ->where('due_date', '<', Carbon::now())
            ->update(['status' => 'overdue']);
    }
}
