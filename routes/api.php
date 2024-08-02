<?php

use App\Http\Controllers\Api\ProductReviewsController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\Api\CategoriesController;

Route::middleware('auth:sanctum')->group(function() {

      Route::post('logout', [SessionController::class, 'destroy']);
//    Brands
  Route::controller(BrandsController::class)->group( function () {
      Route::get('brands', 'index');
      Route::post('brand', 'store');
      Route::post('brand/update/{brand}','update');
      Route::post('brand/delete/{brand}','destroy');
  });

//    Categories
  Route::controller(CategoriesController::class)->group( function () {
      Route::get('categories','index');
      Route::post('category','store');
      Route::post('category/update/{category}','update');
      Route::post('category/delete/{category}','destroy');
  });

//  Products
  Route::controller(ProductsController::class)->group(function (){
        Route::get('products', 'index');
        Route::post('product', 'store');
        Route::post('product/update/{product}', 'update');
        Route::post('product/delete/{product}', 'destroy');

//   Product Reviews
  Route::controller(ProductReviewsController::class)->group( function () {
        Route::post('product/{product}/review' ,'store');
        Route::get('product/{product}/reviews/show' ,'show');
        Route::post('product/review/{productReview}/delete' ,'destroy');
  });
 });

});

Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [SessionController::class, 'store']);
