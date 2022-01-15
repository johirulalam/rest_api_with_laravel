<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Scopes\BuyerScope;

class Buyer extends User
{
    use HasFactory;

    protected static function booted(){
        static::addGlobalScope(new BuyerScope);
    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
