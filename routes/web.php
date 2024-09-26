<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Categories
Route::controller(CategoriesController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories.index');
    Route::get('/categories/create', 'create')->name('categories.create');
    Route::post('/categories', 'store')->name('categories.store');
    Route::post('/categories/{category}/update','update')->name('categories.update');
    Route::post('/categories/{category}/delete', 'destroy')->name('categories.destroy');

});

// Brands
Route::controller(BrandsController::class)->group(function () {
    Route::get('/brands', 'index')->name('brands.index');
    Route::get('/brands/create', 'create')->name('brands.create');
    Route::post('/brands', 'store')->name('brands.store');
    Route::post('/brands/{brand}/update', 'update')->name('brands.update');
    Route::post('/brands/{brand}/delete', 'destroy')->name('brands.destroy');
});

// Products
Route::controller(ProductsController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/create', 'create')->name('products.create');
    Route::post('/products', 'store')->name('products.store');
    Route::get('/products/{product}/edit', 'edit')->name('products.edit');
    Route::post('/products/{product}/update', 'update')->name('products.update');
    Route::post('/products/{product}/delete', 'destroy')->name('products.destroy');

});

// Product Images

Route::controller(ProductImagesController::class)->group(function () {
    Route::post('product/{product}/images/delete', 'destroy')->name('product.images.delete');
});

// Orders
Route::controller(OrdersController::class)->group(function () {
    Route::get('orders', 'index')->name('orders.index');
    Route::post('orders/{order}/delete', 'destroy')->name('orders.delete');
});
