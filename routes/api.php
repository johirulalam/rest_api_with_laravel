<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\controllers\Buyer\BuyerController;
use App\Http\controllers\Seller\SellerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Transaction\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionSellerController;
use App\Http\controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyerSellerController;
use App\Http\controllers\Buyer\BuyerCategoryController;
use App\Http\Controllers\Category\CategoryProductController;
use App\Http\Controllers\Category\CategorySellerController;
use App\Http\Controllers\Category\CategoryTransactionController;
use App\Http\Controllers\Category\CategoryBuyerController;
use App\Http\Controllers\Seller\SellerTransactionController;
use App\Http\Controllers\Seller\SellerCategoryController;
use App\Http\Controllers\Seller\SellerBuyerController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Product\ProductTransactionController;
use App\Http\Controllers\Product\ProductBuyerController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductBuyerTransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::resource('category', CategoryController::class)->except(['create', 'edit']);
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::resource('sellers', SellerController::class)->only(['index', 'show']);
Route::resource('buyers', BuyerController::class)->only(['index', 'show']);
Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
Route::resource('users', UserController::class)->except(['create', 'edit']);


Route::resource('transactions.category', TransactionCategoryController::class)->only('index');
Route::resource('transactions.sellers', TransactionSellerController::class)->only('index');
Route::resource('buyers.transactions', BuyerTransactionController::class)->only('index');
Route::resource('buyers.products', BuyerProductController::class)->only('index');
Route::resource('buyers.sellers', BuyerSellerController::class)->only('index');
Route::resource('buyers.category', BuyerCategoryController::class)->only('index');
Route::resource('category.products', CategoryProductController::class)->only('index');
Route::resource('category.sellers', CategorySellerController::class)->only('index');
Route::resource('category.transactions', CategoryTransactionController::class)->only('index');
Route::resource('category.buyers', CategoryBuyerController::class)->only('index');
Route::resource('sellers.transactions', SellerTransactionController::class)->only('index');
Route::resource('sellers.category', SellerCategoryController::class)->only('index');
Route::resource('sellers.buyers', SellerBuyerController::class)->only('index');
Route::resource('sellers.products', SellerProductController::class);
Route::resource('products.transactions', ProductTransactionController::class)->only('index');
Route::resource('products.buyers', ProductBuyerController::class)->only('index');
Route::resource('products.category', ProductCategoryController::class)->only(['index', 'update', 'destroy']);
// Route::put('products/{product}/category/{category}', [ProductCategoryController::class, 'update']);
Route::resource('products.buyers.transactions', ProductBuyerTransactionController::class)->only('store');
Route::fallback( function(){
    return response()->json([
        'message' => 'Page is not found'], 404);
});


Route::get('users/verify/{token}', [UserController::class, 'verifyEmail'])->name('verify');