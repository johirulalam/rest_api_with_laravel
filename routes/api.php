<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

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


Route::get('/', function () {
    return "hello";
});

Route::resource('users', UserController::class)->only(['index', 'show']);
Route::resource('category', CategoryController::class)->except(['create', 'edit']);
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::resource('sellers', SellerController::class)->only(['index', 'show']);
Route::resource('transaction', TransactionController::class)->only(['index', 'show']);
Route::resource('users', UserController::class)->except(['create','edit']);