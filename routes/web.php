<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LaravelEstriController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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


Route::get("/user-info", [AuthController::class, 'getUserInfo']);

Route::post("/login-action",[AuthController::class, 'login'])->name('login-action');

Route::view("/login", 'auth/login')->name('login');

Route::get("/login",[AuthController::class,'loginView']);

Route::get('/', [App\Http\Controllers\MyMainProfileController::class, 'index'])->name('');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {


    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin']);
    Route::get('/staff', [App\Http\Controllers\HomeController::class, 'index']);


    Route::get("/inbox/manage", [App\Http\Controllers\MessageFromClientController::class, 'manage']);
    Route::post('/user/store', [App\Http\Controllers\StaffController::class, 'store']);
    Route::post('/user/update', [App\Http\Controllers\StaffController::class, 'update']);
    Route::get('/user/{id}/delete', [App\Http\Controllers\StaffController::class, 'destroy']);


    Route::prefix('company-profile')->group(function () {
        Route::prefix('basic-info')->group(function () {
            Route::get("/", [App\Http\Controllers\BasicInfoController::class, 'index']);
            Route::post('store', [App\Http\Controllers\BasicInfoController::class, 'store']);
        });

        Route::middleware("killa")->prefix('slider')->group(function () {
            Route::get('/', [App\Http\Controllers\MyProfileSliderController::class, 'manageSlider']);
            Route::post('store', [App\Http\Controllers\MyProfileSliderController::class, 'store']);
            Route::get('{id}/delete', [App\Http\Controllers\MyProfileSliderController::class, 'destroy']);
            Route::get('{id}/edit', [App\Http\Controllers\MyProfileSliderController::class, 'viewEdit']);
            Route::post('update', [App\Http\Controllers\MyProfileSliderController::class, 'update']);
        });

    });



    Route::get('/admin/user/create', [App\Http\Controllers\StaffController::class, 'viewAdminCreate']);
    Route::get('/admin/user/manage', [App\Http\Controllers\StaffController::class, 'viewAdminManage']);
    Route::get('/admin/user/{id}/edit', [App\Http\Controllers\StaffController::class, 'viewAdminEdit']);
});


Route::get("/cariQuery", "CariQueryController@cari");


Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');
