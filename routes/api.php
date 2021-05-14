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

// route update profile with photo
Route::post('users/update/{id}', [UserController::class, 'updatePhoto']);

// route update item with photo
// route update profile with photo
Route::post('items/update/{id}', [ItemController::class, 'updatePhoto']);

// route soldout
Route::get('soldout', [ItemController::class, 'soldout']);

// get order summary current month
Route::get('currentMonth', [OrderController::class, 'currentMonth']);

// get order summary current year
Route::get('currentYear', [OrderController::class, 'currentYear']);

// get order summary all
Route::get('summary', [OrderController::class, 'summaryAll']);

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
