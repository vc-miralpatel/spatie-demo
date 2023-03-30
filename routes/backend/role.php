



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
});