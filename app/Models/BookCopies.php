<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookCopies extends Model
{
    //
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = [
        "book_Id",
        "copy_number",
        "status",
        "created_at",
        "updated_at"
        ];

        protected function casts(): array
        {
            return [
                "created_at" => "datetime",
                "updated_at"=> "datetime",
            ];
        }

        public function book(): BelongsTo
        {
            return $this->belongsTo(Book::class, 'book_Id', 'book_Id');
        }
}