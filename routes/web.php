<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/users/login', [LoginController::class, 'index'])->name('admin.users.login');

Route::post('admin/users/login/store', [LoginController::class, 'store'])->name('admin.users.login.store');

Route::get('admin/main',[MainController::class,'index'])->name('admin.main');


