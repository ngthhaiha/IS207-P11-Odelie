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
        });
    });
    
    // User Routes
    Route::middleware([checkUser::class])->group(function () {
        Route::get('home', [HomeController::class, 'home'])->name('home');
    });
});
