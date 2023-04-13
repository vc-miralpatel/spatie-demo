<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Dashboard\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Backend\ProductController;


Route::group(['middleware' => ['admin.auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('products', ProductController::class);
});

//'can:show,App\User'
// Route::group(['middleware' => ['auth', 'role:Super-admin']], function () {
//     Route::resource('products', ProductController::class);
// });

//$this->middleware('permission:role-delete', ['only' => ['destroy']]);


// Route::group(['middleware' => ['auth','permission:unpublish articles']], function () {
//     Route::resource('products', ProductController::class);
// });