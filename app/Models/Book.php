<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    protected $primaryKey = "book_Id";
    protected $fillable = [
        "book_Id",
        "title",
        "description",
        "book_cover_image_path",
        "isbn",
        "pages",
        "quantity",
        "borrowed_copies",
        "released_date",
        "published_date",
        "author_id",
        "publisher_Id",
        "language",
    ];

    protected $casts = [
        'published_date' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'author_Id');
    }

    public function pulisher(): BelongsTo
    {
        return $this->belongsTo(Pulisher::class, 'pulisher_Id', 'pulisher_Id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'book_category','book_Id','category_Id')->withTimestamps();
    }

    public function copies(): HasMany
    {
        return $this->hasMany(BookCopies::class, 'book_Id', 'book_Id');
    }
}
