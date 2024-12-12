<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\Users\RegisterController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\checkAdmin;
use App\Http\Middleware\checkUser;
use App\Http\Controllers\User\HomeController;
use App\Models\Category;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\PaymentController;


Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');


//Xin chào 

Route::get('/', function () {
    return view('welcome');
});



//Authen routes
Route::get('admin/users/register', [RegisterController::class, 'index'])->name('admin.users.register');
Route::get('login', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('login', [LoginController::class, 'postLogin'])->name('postLogin'); 
Route::get('logout', [LoginController::class, 'getLogout'])->name('getLogout');


// Admin and User Routes with Middleware
Route::middleware(['auth'])->group(function () {

    // Admin Routes
    Route::middleware([checkAdmin::class])
    ->prefix('admin')
    ->group(function () {
        Route::get('main', [MainController::class, 'index'])->name('main');

        #Category
        Route::prefix('category')->group(function(){
            Route::get('add', [CategoryController::class, 'create']);
            Route::post('add', [CategoryController::class, 'store']);
            Route::get('edit/{category}', [CategoryController::class, 'show']);
            Route::post('edit/{category}', [CategoryController::class, 'update']);
            Route::get('list', [CategoryController::class, 'index']);            
            Route::post('delete', [CategoryController::class, 'delete']);

        });
        # Inventory Management
        Route::prefix('inventory')->group(function(){
            Route::get('list', [InventoryController::class, 'list'])->name('inventory.list');
            Route::put('update/{productId}', [InventoryController::class, 'update'])->name('inventory.update');
            Route::get('low-stock', [InventoryController::class, 'checkLowStock'])->name('inventory.lowStock');
        });



        Route::prefix('products')->group(function(){
            

        });
    });
    
    // User Routes
    Route::middleware([checkUser::class])->group(function () {
        Route::get('home', [HomeController::class, 'home'])->name('home');

        # Cart Management
        Route::prefix('cart')->group(function () {
            Route::post('add', [CartController::class, 'addToCart'])->name('cart.add');
            Route::put('update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
            Route::delete('remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        });

        # Wishlist Management
        Route::prefix('wishlist')->group(function () {
            Route::post('add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
            Route::delete('remove/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
        });



    });
});
