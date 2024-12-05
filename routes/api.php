<?php

use App\Http\Controllers\Api\CardPaymentsController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckoutController;
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
    Route::middleware('isAdmin')->group(function (){
        //    Brands
        Route::controller(BrandsController::class)->group( function () {
            Route::get('brands', 'index');
            Route::post('brand', 'store');
            Route::post('brand/update/{brand}','update');
            Route::post('brand/delete/{brand}','destroy');
        });
        //     Categories
        Route::controller(CategoriesController::class)->group( function () {
            Route::get('categories','index');
            Route::post('category','store');
            Route::post('category/update/{category}','update');
            Route::post('category/delete/{category}','destroy');
        });
        //    Products
        Route::controller(ProductsController::class)->group(function (){
            Route::post('product', 'store');
            Route::post('product/update/{product}', 'update');
            Route::post('product/delete/{product}', 'destroy');
        });
        //    Product Images
        Route::controller(ProductImagesController::class)->group(function (){
            Route::post('product/{product}/images/delete', 'destroy');
        });
        //  Inventory
        Route::controller(InventoryController::class)->group(function (){
            Route::post('product/{product}/stock/store', 'store');
        });
    });

//  User Routes
    //     Product Reviews
    Route::prefix('product')->controller(ProductReviewsController::class)->group( function () {
        Route::get('{product}/reviews/show' ,'show');
        Route::post('{product}/review' ,'store');
        Route::post('review/{productReview}/update', 'update');
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
        Route::get('/', 'index');
        Route::post('place-order/{order}', 'placeOrder');
        Route::post('cancel/{order}', 'cancel');
        Route::post('delete/{order}', 'destroy');
    });
    Route::get('order/track', [OrdersController::class, 'trackOrder']);

//   Order Payments
    Route::controller(OrderPaymentsController::class)->group(function () {
        Route::post('order/payments/{order}', 'store');
    });
//   Stripe Checkout
    Route::controller(CheckoutController::class)->group(function () {
        Route::post('checkout', 'checkout');
//        Route::get('success', 'success')->name('checkout.success');
//        Route::get('cancel', 'cancel')->name('checkout.cancel');
    });
});
//   Stripe Card Payments (Payment Element)

Route::controller(CardPaymentsController::class)->group(function (){
    Route::get('/payment/{orderId}', 'showPaymentForm')->name('payment.form');
    Route::post('/create-payment-intent','createPaymentIntent')->name('payment.intent');
    Route::get('payment-complete', 'paymentComplete')->name('payment.complete');
});
Route::controller(CheckoutController::class)->group(function (){
    Route::get('success', 'success')->name('checkout.success');
    Route::get('cancel', 'cancel')->name('checkout.cancel');
});
Route::get('products', [ProductsController::class, 'index']);
