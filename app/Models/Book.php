<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        "book_Id",
        "title",
        "description",
        "book_cover_image_path",
        "isbn",
        "released_date",
        "published_date",
        "author_id",
        "publisher_Id",
        "category_Id",
    ];

    protected $casts = [
        'published_date' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'author_Id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_Id', 'category_Id');
    }
}
