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

use App\Http\Controllers\PaymentController;

Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');


Route::get('/', function () {
    return view('welcome');
});

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

        Route::prefix('products')->group(function(){
            

        });
    });
    
    // User Routes
    Route::middleware([checkUser::class])->group(function () {
        Route::get('home', [HomeController::class, 'home'])->name('home');
    });
});
