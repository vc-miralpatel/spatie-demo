
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Auth\AdminLoginController;

Route::group(['prefix' => '', 'as' => '', 'controller' => AdminLoginController::class], function () {
    //Admin login route
    Route::get('/login',  'showLoginForm')->name('adminlogin');
    Route::post('/login', 'login')->name('login');

    //only authenticated user access this route
    Route::middleware('auth')->group(function () {
        Route::get('/logout', 'logout')->name('logout');
    });

});