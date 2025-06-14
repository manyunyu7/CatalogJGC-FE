<?php

use App\Http\Controllers\FasilitasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/our-clients', [App\Http\Controllers\MyProfileClientController::class, 'getClientList']);
Route::get('/find-id-by-slug', [App\Http\Controllers\MyBrandConentController::class, 'find']);


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', 'CustomAuthController@login');
    Route::post('/logout', 'CustomAuthController@logout');
    Route::post('/refresh', 'CustomAuthController@refresh');
    Route::any('/user-profile', 'CustomAuthController@me');
});

Route::post('auth/register', 'CustomAuthController@register');
Route::get('auth/check-number', 'StaffController@checkIfNumberRegistered');

Route::prefix("user")->group(function(){
    Route::get('{id}', 'StaffController@profile');
});

Route::get('sodaqo-category', 'MobileCategoryController@getAll');

Route::prefix("sodaqo")->group(function(){
    Route::get('recent', 'MobileSodaqoAllController@recent');
    Route::get('all', 'MobileSodaqoAllController@getAll');
    Route::get('{id}', 'MobileSodaqoAllController@getDetailSodaqo');
    Route::get('{id}/detail', 'MobileSodaqoAllController@getDetailSodaqo');
    Route::get('{id}/people',[App\Http\Controllers\MobileSodaqoAllController::class, 'getPeople']);


    Route::prefix("category")->group(function(){
        Route::get('/{id}',  [App\Http\Controllers\MobileSodaqoAllController::class, 'getByCategoryId']);
    });
});


Route::prefix("history")->group(function(){
    Route::get('user/{id}',  [App\Http\Controllers\MobileSodaqoUserController::class, 'getSodaqoByUser']);
    Route::get('{id}/detail',  [App\Http\Controllers\MobileSodaqoUserController::class, 'getDetailHistory']);
});



Route::any('donation-account', 'MobileSodaqoAllController@getPaymentAccount');


Route::prefix("sodaqo-user")->group(function(){
    Route::post('store', 'MobileSodaqoUserController@store');
    Route::post('update', 'MobileSodaqoUserController@update');
});


Route::prefix('mnotification')->group(function () {
    Route::get('get', 'MNotificationController@getByUser');
    Route::get('user/{id}', 'MNotificationController@getByUser');
    Route::get('setRead/{id}', 'MNotificationController@setRead');
});

Route::prefix("komplain")->group(function (){
    $cr = "KomplainsController";
    Route::post('upload', "$cr@upload");
});

Route::prefix("fix-data")->group(function (){
    $cr = "ReportMistakeController";
    Route::post('upload', "$cr@upload");
});

Route::get('/stats', 'AndroidHomeController@stats');

Route::prefix('news')->group(function () {
    Route::get('/get', 'NewsController@get');
});

Route::get('/colek-service', 'ColekController@colek');
Route::get('/auth/colek', 'ColekController@colek');
Route::post('/auth/registerNumber', 'StaffController@registerNumber');

Route::prefix('user')->group(function () {
    Route::post('{id}/checkPassword', 'StaffController@checkPassword');
    Route::post('{id}/updatePasswordCompact', 'StaffController@updatePasswordCompact');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix('user')->group(function () {
        Route::post('/update-photo', 'StaffController@updateProfilePhoto');
        Route::post('/update-data', 'StaffController@update');
        Route::post('/change-password', 'StaffController@updatePassword');
    });



    Route::prefix('price')->group(function () {
        Route::get('/', 'PriceController@getAll');
    });

    Route::post('save-user', 'UserController@saveUser');
    Route::put('edit-user', 'UserController@editUser');
});






