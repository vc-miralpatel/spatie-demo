
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


