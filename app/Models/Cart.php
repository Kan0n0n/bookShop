<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cart_Items;
use App\Models\BorrowBook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        "user_id",
        "status",
        "checkout_date",
        "note",
    ];

    protected $casts = [
        "status"=> "string",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Cart_Item::class);
    }

    public function borrowBooks(): HasMany
    {
        return $this->hasMany(BorrowBook::class);
    }
}
