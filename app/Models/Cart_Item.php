<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart_Item extends Model
{
    //
    use HasFactory;
    //
    protected $fillable = [
        "cart_id",
        "book_copy_id",
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function book_copy(): BelongsTo
    {
        return $this->belongsTo(BookCopies::class);
    }
}