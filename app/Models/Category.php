<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        "category_Id",
        "name",
        "category_Description",
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'category_Id', 'category_Id');
    }
}
