<?php

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

// Categories
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.list');
Route::get('/category/create', [CategoriesController::class, 'create'])->name('category.add');

// Products
Route::get('/products', [ProductsController::class, 'index'])->name('products.list');
Route::get('/product/create', [ProductsController::class, 'create'])->name('product.add');

// Brands
Route::get('/brands', [BrandsController::class, 'index'])->name('brands.list');
Route::get('/brand/create', [BrandsController::class, 'create'])->name('brand.add');
