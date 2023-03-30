
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProductController;

Route::group(['middleware' => ['auth']], function() {
    Route::resource('products', ProductController::class);
});
