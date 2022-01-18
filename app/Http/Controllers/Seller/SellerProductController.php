<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        //
        $products = $seller->products;
        return $this->showAll($products);
    }

    public function store(Request $request, User $seller){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->status = $request->quantity > 0 ? Product::AVAILABLE_PRODUCT : Product::UNAVAILABLE_PRODUCT;
        $product->image = "2.jpg";
        $product->seller_id = $seller->id;
        $product->save();

        return $this->showOne($product);
    }

    public function update(Request $request, Seller $seller, Product $product){

        $request->validate([
            'quantity' => 'integer|min:1',
            'status' => 'in:'.Product::AVAILABLE_PRODUCT.','.Product::UNAVAILABLE_PRODUCT,
            'image' => 'image',
        ]);

        $this->checkSeller($seller,$product);

        if($request->has('name')) {
            $product->name = $request->name;
        }
        if($request->has('description')){
            $product->description = $request->description;
        }
        if($request->has('quantity')) {
            $product->quantity = $request->quantity;
        }

        if($request->has('status')) {
            $product->status = $request->status;

            if($product->isAvailable() && $product->categories()->count()==0){
                return $this->errorResponse('An active product must have at least one category', 409);
            }
        }

        if($product->isClean()){
            return $this->errorResponse('You need to specify a diferent value to update', 422);
        }

        $product->save();
        return $this->showOne($product);
    }

    public function destroy(Seller $seller, Product $product){

        $this->checkSeller($seller, $product);

        $product->delete();
        return $this->showOne($product);
    }

    public function checkSeller(Seller $seller, Product $product){
        if($seller->id != $product->seller_id) {
            throw new HttpException(422, 'the specified seller is not actual seller is this product');
        }
    }


}
