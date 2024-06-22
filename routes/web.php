<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\ProductController;
use app\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class)->middleware('auth');
Route::resource('cart', CartController::class)->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
