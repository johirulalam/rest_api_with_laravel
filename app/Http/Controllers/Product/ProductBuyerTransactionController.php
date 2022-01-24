<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DB;

class ProductBuyerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $buyer)
    {
        //
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($product->seller_id == $buyer->id){
            return $this->errorResponse('the seller can not buy his own product',409);
        }

        if(!$product->isAvailable() && $product->quantity < 1){
            return $this->errorResponse('Your Product is not available for now', 409);
        }
        if($product->quantity < $request->quantity){
            return $this->errorResponse('This number of quantity for this product is not stock please minimumm your quantity', 409);
        }
        if ($product->quantity >= $request->quantity) {
            DB::transaction(function() use ($request, $product, $buyer){
                $product->quantity = $product->quantity - $request->quantity;
                $product->save();
            });
            $transaction = new transaction();
            $transaction->quantity = $request->quantity;
            $transaction->buyer_id = $buyer->id;
            $transaction->product_id = $product->id;
            $transaction->save();

            return $this->showOne($transaction);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
