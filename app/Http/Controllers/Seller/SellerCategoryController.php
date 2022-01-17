<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(seller $seller)
    {
        //
        $category = $seller->products()->wherehas('categories')->with('categories')->get()->pluck('categories')->collapse();
        return $this->showAll($category);
    }
    
}
