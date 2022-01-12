<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Scopes\SellerScope;

class Seller extends User
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new SellerScope);
    }
    public function products() {
        return $this->hasMany(Product::class);
    }
}
