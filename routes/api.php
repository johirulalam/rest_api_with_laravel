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


Route::resource('users', UserController::class)->only(['index', 'show']);
Route::resource('category', CategoryController::class)->except(['create', 'edit']);
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::resource('sellers', SellerController::class)->only(['index', 'show']);
Route::resource('buyers', BuyerController::class)->only(['index', 'show']);
Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
Route::resource('users', UserController::class)->except(['create','edit']);


Route::resource('transactions.category', TransactionCategoryController::class)->only('index');
Route::resource('transactions.sellers', TransactionSellerController::class)->only('index');
Route::resource('buyers.transactions', BuyerTransactionController::class)->only('index');
Route::resource('buyers.products', BuyerProductController::class)->only('index');
Route::resource('buyers.sellers', BuyerSellerController::class)->only('index');
Route::resource('buyers.category', BuyerCategoryController::class)->only('index');
Route::resource('category.products', CategoryProductController::class)->only('index');
Route::resource('category.sellers', CategorySellerController::class)->only('index');

Route::fallback( function(){
    return response()->json([
        'message' => 'Page is not found'], 404);
});