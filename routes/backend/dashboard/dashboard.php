<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Dashboard\DashboardController;


Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

//Route::group(['prefix' => '', 'as' => '', 'controller' => AdminLoginController::class], function () {
// Route::middleware('auth')->group([ 'controller' => DashboardController::class], function () {
//     Route::get('/dashboard', 'index')->name('dashboard');
// });

// Route::group(['prefix' => 'login', 'as' => 'l.', 'controller' => UserDiyaController::class], function () {
//     /* route provide avialable diya */
//    Route::get('/lightupdiya/{selectedDiyaId}/{selectedScreenId}', 'getDiyaRecord')->name('getDiyaRecord');

//     /* route for update diyarecord  */
//    Route::post('/updateDiyaRecord', 'updateDiyaRecord')->name('updateDiyaRecord');

//    /* route for reset */
//   // Route::get('/reset/{actionStatus}', 'resetStatus')->name('resetStatus');
//    Route::get('/reset/{actionStatus}/{screenId}', 'resetStatus')->name('resetStatus');


//     /* get list of screen 1 data */
//    Route::get('/screen1', 'screen1')->name('screen1');

//    /* get list of screen list */
//    Route::get('/get-screen-list', 'getScreenLists')->name('get-screen-list');

//    /* get last light up diya */
//    Route::get('/get-last-light-up-diya', 'getLastLightUpDiya')->name('get-last-light-up-diya');

//    /* get last light up diya (work on progress - not done) */
//    //Route::get('/screen-lightup-diya-count/{id}', 'getScreenLightupDiya')->name('get-screen-light-up-diya');

//    /* get all user diya lightup records for show And export*/
//    Route::get('/lightup-records', 'getUserDiyaLightupRecords')->name('lightup-records');

//    /* get all user diya lightup records for exort report*/
//    Route::get('/lightup-records-export', 'getUserDiyaLightupRecordsExport')->name('lightup-records.export');
// });