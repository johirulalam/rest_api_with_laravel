<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = [
        'pivot',
    ];

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
