<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;

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

Route::resource('users', UserController::class);
Route::resource('items', ItemController::class);
Route::resource('orders', OrderController::class);
Route::resource('categories', CategoryController::class);

// route about
Route::get('about', [UserController::class, 'about']);

// route login
Route::post('login', [UserController::class, 'login']);

// route checkout
Route::post('orders/checkout', [OrderController::class, 'checkout']);


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
