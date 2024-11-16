<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_Id';

    protected $fillable = [
        "category_Id",
        "name",
        "category_Description",
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class,'book_category','category_Id','book_Id');
    }
}
