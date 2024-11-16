<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Review extends Model
{
    //
    protected $primaryKey = 'review_Id';
    protected $fillable = [
        'review_Id',
        'book_Id',
        'user_Id',
        'rating',
        'review',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_Id', 'id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_Id', 'book_Id');
    }
}