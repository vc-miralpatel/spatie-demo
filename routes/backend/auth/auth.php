
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Auth\AdminLoginController;


//With admin prefix
// Route::prefix('admin')->as('admin.')->group(function () {
//     //Admin login route
//     Route::get('login', [AdminLoginController::class, 'showLoginForm']);
//     Route::post('login', [AdminLoginController::class, 'login'])->name('login');

//     //only authenticated user access this route
//     Route::middleware('auth')->group(function () {
//         Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
//     });
// });

Route::group(['prefix' => '', 'as' => '', 'controller' => AdminLoginController::class], function () {
    //Route::get('/login', [AdminLoginController::class, 'showLoginForm']);
  //  Route::post('/login', [AdminLoginController::class, 'login'])->name('login');
    Route::get('/login',  'showLoginForm')->name('adminlogin');
    Route::post('/login', 'login')->name('login');

    //only authenticated user access this route
    Route::middleware('auth')->group(function () {
        //Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
        Route::get('/logout', 'logout')->name('logout');
    });

});
//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('login', [AdminLoginController::class, 'showLoginForm']);
// Route::post('login', [AdminLoginController::class, 'login'])->name('login');

// Route::group(['prefix' => 'login', 'as' => '', 'controller' => UserDiyaController::class], function () {
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