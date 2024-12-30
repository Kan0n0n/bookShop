<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pulisher extends Model
{
    use HasFactory;
    protected $primaryKey = "pulisher_Id";
    protected $fillable = [
        "pulisher_Id",
        "name",
        "address",
        "phone",
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'pulisher_Id', 'pulisher_Id');
    }
}
