<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pulisher extends Model
{
    use HasFactory;

    protected $fillable = [
        "pulishers_Id",
        "name",
        "address",
        "phone",
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'pulishers_Id', 'pulishers_Id');
    }
}
