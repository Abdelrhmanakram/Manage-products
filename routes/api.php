<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\productController;
use App\Http\Controllers\categoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // Product routes
    Route::get('/products', [productController::class, 'index']);
    Route::post('/products', [productController::class, 'store']);
    Route::get('/products/{id}', [productController::class, 'show']);
    Route::put('/products/{id}', [productController::class, 'update']);
    Route::delete('/products/{id}', [productController::class, 'destroy']);

    // Category routes
    Route::get('/categories', [categoryController::class, 'index']);
    Route::post('/categories', [categoryController::class, 'store']);
    Route::get('/categories/{id}', [categoryController::class, 'show']);
    Route::put('/categories/{id}', [categoryController::class, 'update']);
    Route::delete('/categories/{id}', [categoryController::class, 'destroy']);

    // Price routes
    Route::get('/prices', [PriceController::class, 'index']);
    Route::post('/prices', [PriceController::class, 'store']);
    Route::get('/prices/{id}', [PriceController::class, 'show']);
    Route::put('/prices/{id}', [PriceController::class, 'update']);
    Route::delete('/prices/{id}', [PriceController::class, 'destroy']);

    // Route to get the product with its current price based on the current date
    Route::get('/product/current-price/{id}', [PriceController::class, 'getCurrentProductPrice']);

    // Order routes
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

    Route::post('logout', [AuthController::class, 'logout']);
});
