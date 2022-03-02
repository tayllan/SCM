<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::post('/cart', [CartController::class, 'store']);
Route::get('/cart/{id}', [CartController::class, 'show']);
Route::delete('/item', [CartController::class, 'destroy']);
Route::post('/item', [CartController::class, 'update']);
Route::post('/checkout', [CartController::class, 'checkout']);
