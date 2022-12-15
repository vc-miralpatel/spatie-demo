<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'backend', 'as' => 'backend.', 'middleware' => []], function () {
   includeRouteFiles(__DIR__.'/backend/');
});


/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */

Route::group(['as' => 'frontend.', 'middleware' => []], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

