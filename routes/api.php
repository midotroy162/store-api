<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductColorController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('user', [AuthController::class, 'user']);
      
    });
});

Route::delete('/categories/delete', [CategoryController::class, 'delete']);
Route::apiResource('categories', CategoryController::class)->except('destroy','create','edit' );
Route::apiResource('products', ProductController::class)->except('destroy','create','edit');
Route::delete('/products/delete', [ProductController::class, 'delete']);
Route::apiResource('productcolors', ProductColorController::class)->except('destroy','create','edit' );
Route::delete('/productcolors/delete', [ProductColorController::class, 'delete']);
Route::apiResource('reviews', ReviewController::class)->except('destroy','create','edit');
Route::delete('/reviews/delete', [ReviewController::class, 'delete']);

