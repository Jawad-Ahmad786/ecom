<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\Api\CategoriesController;

Route::middleware('auth:sanctum')->group(function() {

      Route::post('logout', [SessionController::class, 'destroy']);
//    Brands
  Route::controller(BrandsController::class)->group( function () {
      Route::post('brand', 'store');
      Route::get('brands', 'index');
      Route::post('brand/update/{brand}','update');
      Route::post('brand/delete/{brand}','destroy');
  });

//    Categories
  Route::controller(CategoriesController::class)->group( function () {
      Route::post('category','store');
      Route::get('categories','index');
      Route::post('category/update/{category}','update');
      Route::post('category/delete/{category}','destroy');
  });
});

Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [SessionController::class, 'store']);
