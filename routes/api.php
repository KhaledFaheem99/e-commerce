<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\API\V1\Auth\AuthController;
use App\Http\Controllers\API\v1\Admin\Categories\CategoryController;
use App\Http\Controllers\Api\v1\Admin\Orders\OrderAdminController;
use App\Http\Controllers\API\v1\Admin\Products\ProductController;
use App\Http\Controllers\Api\v1\Filter\FilterController;
use App\Http\Controllers\Api\v1\TopSelling\TopSellingController;
use App\Http\Controllers\API\v1\User\CartItem\CartItemController;
use App\Http\Controllers\API\v1\User\Order\OrderController;

// Auth :
Route::prefix('auth/v1')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/registerOtp', 'sendRegisterOtp');
        Route::post('/register'   , 'verifyAccount'  );
        Route::post('/login'      , 'login'  );
        Route::get ('/profile'    , 'profile');
        Route::post('/refresh'    , 'refresh');
        Route::post('/logout'     , 'logout' );
    });
});

// Categories Control :
Route::prefix('admin/categories/v1')->group(function () {
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/categories','index');
            Route::post('/categories','store');
            Route::Post('/categories/{id}','show');
            Route::patch('/categories/{id}','update');
            Route::delete('/categories/{id}','destroy');
        });
    });
});

// Products Control :
Route::prefix('admin/products/v1')->group(function () {
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('/products','index');
            Route::post('/products','store');
            Route::Post('/products/{id}','show');
            Route::patch('/products/{id}','update');
            Route::delete('/products/{id}','destroy');
        });
    });
});

// Cart Items :
Route::prefix('user/cartItems/v1')->group(function () {
    Route::middleware(UserMiddleware::class)->group(function () {
        Route::controller(CartItemController::class)->group(function () {
            Route::post   ('/cart' , 'addToCart');
            Route::get    ('/cart' , 'showCart');
            Route::put    ('/cart/{id}' , 'updateCart');
            Route::delete ('/cart/{id}' , 'removeFromCart');
        });
    });
});

// Orders :
Route::prefix('user/orders/v1')->group(function () {
    Route::middleware(UserMiddleware::class)->group(function () {
        Route::controller(OrderController::class)->group(function () {
            Route::post('/orders' , 'store');
        });
    });
});

// Filters :
Route::prefix('filters/v1')->group(function () {
        Route::controller(FilterController::class)->group(function () {
            Route::Post('/globalSearch' , 'global');
            Route::Post('/filter'       , 'filter');
        });
});

// TopSelling :
Route::Get('/topSelling' , [TopSellingController::class , 'getTopSelling']);

// AdminOrders
Route::middleware(AdminMiddleware::class)->group(function () {
        Route::controller(OrderAdminController::class)->group(function () {
            Route::Get ('/orders'      , 'index');
            Route::Post('/orders/{id}' , 'update');
        });
});