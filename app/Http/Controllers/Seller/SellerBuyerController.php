<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        //
        $buyers = $seller->products()->with('transactions.buyer')->get()->pluck('transactions')->collapse()->pluck('buyer')->unique('id')->values();
        return $this->showAll($buyers);
    }
}
