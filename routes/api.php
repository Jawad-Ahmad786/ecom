<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\OrderPaymentsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductImagesController;
use App\Http\Controllers\Api\ProductReviewsController;
use App\Http\Controllers\Api\ProductReviewsImagesController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\Api\CategoriesController;

//    Auth
Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [SessionController::class, 'store']);

Route::middleware('auth:sanctum')->group(function() {

      Route::post('logout', [SessionController::class, 'destroy']);
//      Admin Routes

    //    Brands
  Route::middleware('isAdmin')->controller(BrandsController::class)->group( function () {
      Route::get('brands', 'index');
      Route::post('brand', 'store');
      Route::post('brand/update/{brand}','update');
      Route::post('brand/delete/{brand}','destroy');
  });

//     Categories
  Route::middleware('isAdmin')->controller(CategoriesController::class)->group( function () {
      Route::get('categories','index');
      Route::post('category','store');
      Route::post('category/update/{category}','update');
      Route::post('category/delete/{category}','destroy');
  });

//    Products
  Route::middleware('isAdmin')->controller(ProductsController::class)->group(function (){
        Route::get('products', 'index');
        Route::post('product', 'store');
        Route::post('product/update/{product}', 'update');
        Route::post('product/delete/{product}', 'destroy');
  });
//  Inventory
  Route::middleware('isAdmin')->controller(InventoryController::class)->group(function (){
        Route::post('product/{product}/stock/store', 'store');
  });
//  Product Images
  Route::controller(ProductImagesController::class)->group(function (){
        Route::post('product/{product}/images/delete', 'destroy');
  });
//  User Routes

  //     Product Reviews
  Route::prefix('product')->controller(ProductReviewsController::class)->group( function () {
        Route::post('{product}/review' ,'store');
        Route::get('{product}/reviews/show' ,'show');
        Route::post('review/{productReview}/update' ,'update');
        Route::post('review/{productReview}/delete' ,'destroy');
  });
//  Product Review Images
    Route::prefix('product')->controller(ProductReviewsImagesController::class)->group( function () {
       Route::post('product-review/{productReview}/images/delete', 'destroy');
    });
//  Cart
    Route::prefix('cart')->controller(CartController::class)->group(function () {
          Route::get('cart-items', 'index');
          Route::post('add-to-cart', 'store');
          Route::post('delete-cart-items', 'destroy');
    });

//     Orders
    Route::prefix('orders')->controller(OrdersController::class)->group(function (){
        Route::get('/', 'index'); // This will handle 'GET /orders'
        Route::post('place-order/{order}', 'placeOrder'); // This will handle 'POST /orders/place-order/{order}'
        Route::post('cancel/{order}', 'cancel'); // This will handle 'POST /orders/cancel/{order}'
        Route::post('delete/{order}', 'destroy'); // This will handle 'POST /orders/delete/{order}'
    });

    Route::get('order/track', [OrdersController::class, 'trackOrder']); // This will handle 'GET /order/track'

//   Order Payments
   Route::controller(OrderPaymentsController::class)->group(function () {
        Route::post('order/payments/{order}', 'store');
   });
});
