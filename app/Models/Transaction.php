<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buyer;
use App\Models\Product;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id',
    ];


    public function buyer() {
        return $this->belongsTo(Buyer::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}

