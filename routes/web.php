<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LaravelEstriController;
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

Route::view('/template/home', 'template');
Route::view('/profile/home', 'profile/eterna/home');
Route::view('/brand', 'profile/eterna/brand/brand_detail');
Route::view('/profile/home2', 'profile/home8');
Route::view('/profile/home3', 'profile/home3');


Route::get('s3/image-upload', [LaravelEstriController::class, 'imageUpload'])->name('image.upload');
Route::post('s3/image-upload', [LaravelEstriController::class, 'imageUploadPost'])->name('image.upload.post');


Route::get("/user-info", [AuthController::class, 'getUserInfo']);


Route::post("/login-action",[AuthController::class, 'login'])->name('login-action');

Auth::routes();

Route::get("/brand/{slug}", [App\Http\Controllers\MyBrandConentController::class, 'getProductByBrand']);
Route::get("/category/{slug}", [App\Http\Controllers\MyBrandConentController::class, 'getProductByBrand']);
Route::get("/product/{slug}", [App\Http\Controllers\MyProductDetailController::class, 'getProduct']);
Route::get("/products/", [App\Http\Controllers\MyBrandConentController::class, 'getProductAll']);
Route::get("/about-us/", [App\Http\Controllers\AboutController::class, 'about']);
Route::get("/gallery/", [App\Http\Controllers\MyGalleryController::class, 'index']);


Route::get("/product/{id}/related", [App\Http\Controllers\MyProductDetailController::class, 'relatedProduct']);

Route::get('/', [App\Http\Controllers\MyMainProfileController::class, 'index'])->name('');
Route::post('/send-client-message', [App\Http\Controllers\MessageFromClientController::class, 'store']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {


    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin']);
    Route::get('/staff', [App\Http\Controllers\HomeController::class, 'index']);


    Route::get("/inbox/manage", [App\Http\Controllers\MessageFromClientController::class, 'manage']);

    Route::prefix('outbond')->group(function () {
        Route::get('create', 'OutbondController@viewCreate');
        Route::post('store', 'OutbondController@store');
        Route::get('{id}/cancel', 'OutbondController@cancelKeluar');
        Route::post('/update', 'OutbondController@update');
        Route::get('{id}/delete', 'OutbondController@destroy');
        Route::get('manage', 'OutbondController@viewManage');
    });


    Route::post('/user/store', [App\Http\Controllers\StaffController::class, 'store']);
    Route::post('/user/update', [App\Http\Controllers\StaffController::class, 'update']);
    Route::get('/user/{id}/delete', [App\Http\Controllers\StaffController::class, 'destroy']);



    Route::get('/material/create', [App\Http\Controllers\MaterialController::class, 'viewCreate']);
    Route::get('/material/{id}/delete', [App\Http\Controllers\MaterialController::class, 'destroy']);

    Route::post('/material/store', 'MaterialController@store');
    Route::get('/material/{id}/edit', 'MaterialController@edit');
    Route::post('/material/update', 'MaterialController@update');
    Route::get('/material/{id}/delete', 'MaterialController@destroy');
    Route::get('/material/manage', 'MaterialController@viewManage');


    Route::prefix('company-profile')->group(function () {
        Route::get('create', [App\Http\Controllers\CustomerController::class, 'viewCreate']);
        Route::get('{id}/delete', [App\Http\Controllers\CustomerController::class, 'destroy']);

        Route::prefix('basic-info')->group(function () {
            Route::get("/", [App\Http\Controllers\BasicInfoController::class, 'index']);
            Route::post('store', [App\Http\Controllers\BasicInfoController::class, 'store']);
        });
        Route::prefix('slider')->group(function () {
            Route::get('/', [App\Http\Controllers\MyProfileSliderController::class, 'manageSlider']);
            Route::post('store', [App\Http\Controllers\MyProfileSliderController::class, 'store']);
            Route::get('{id}/delete', [App\Http\Controllers\MyProfileSliderController::class, 'destroy']);
            Route::get('{id}/edit', [App\Http\Controllers\MyProfileSliderController::class, 'viewEdit']);
            Route::post('update', [App\Http\Controllers\MyProfileSliderController::class, 'update']);
        });

        Route::prefix('brand')->group(function () {
            Route::get('/', [App\Http\Controllers\MyProfileBrandController::class, 'manage']);
            Route::post('store', [App\Http\Controllers\MyProfileBrandController::class, 'store']);
            Route::get('{id}/delete', [App\Http\Controllers\MyProfileBrandController::class, 'destroy']);
            Route::get('{id}/edit', [App\Http\Controllers\MyProfileBrandController::class, 'viewEdit']);
            Route::post('update', [App\Http\Controllers\MyProfileBrandController::class, 'update']);
        });

        Route::prefix('client')->group(function () {
            Route::get('/', [App\Http\Controllers\MyProfileClientController::class, 'manage']);
            Route::post('store', [App\Http\Controllers\MyProfileClientController::class, 'store']);
            Route::get('{id}/delete', [App\Http\Controllers\MyProfileClientController::class, 'destroy']);
            Route::get('{id}/edit', [App\Http\Controllers\MyProfileClientController::class, 'viewEdit']);
            Route::post('update', [App\Http\Controllers\MyProfileClientController::class, 'update']);
        });

        Route::prefix('whatsapp')->group(function () {
            Route::get('/manage', [App\Http\Controllers\MyWhatsappController::class, 'manage']);
            Route::post('store', [App\Http\Controllers\MyWhatsappController::class, 'store']);
            Route::get('{id}/delete', [App\Http\Controllers\MyWhatsappController::class, 'destroy']);
            Route::get('{id}/edit', [App\Http\Controllers\MyWhatsappController::class, 'viewEdit']);
            Route::post('update', [App\Http\Controllers\MyWhatsappController::class, 'update']);
        });

        Route::prefix('gallery')->group(function () {
            Route::get('manage', [App\Http\Controllers\MyGalleryController::class, 'manage']);
            Route::post('store', [App\Http\Controllers\MyGalleryController::class, 'store']);
            Route::get('{id}/delete', [App\Http\Controllers\MyGalleryController::class, 'destroy']);
            Route::get('{id}/edit', [App\Http\Controllers\MyGalleryController::class, 'viewEdit']);
            Route::post('update', [App\Http\Controllers\MyGalleryController::class, 'update']);
        });

        Route::post('store', 'SupplierController@store');
        Route::get('{id}/edit', 'SupplierController@viewEdit');
        Route::post('update', 'SupplierController@update');
        Route::get('{id}/delete', 'SupplierController@destroy');
        Route::get('/customer/manage', 'SupplierController@viewManage');
    });

    Route::prefix('customer')->group(function () {
        Route::get('create', [App\Http\Controllers\CustomerController::class, 'viewCreate']);
        Route::get('{id}/delete', [App\Http\Controllers\CustomerController::class, 'destroy']);
        Route::post('store', [App\Http\Controllers\SupplierController::class, 'store']);
        Route::get('{id}/edit', 'SupplierController@viewEdit');
        Route::post('update', 'SupplierController@update');
        Route::get('{id}/delete', 'SupplierController@destroy');
        Route::get('/customer/manage', 'SupplierController@viewManage');
    });

    Route::get('/supplier/create', [App\Http\Controllers\SupplierController::class, 'viewCreate']);
    Route::get('/supplier/{id}/delete', [App\Http\Controllers\SupplierController::class, 'destroy']);
    Route::post('/supplier/store', 'SupplierController@store');
    Route::get('/supplier/{id}/edit', 'SupplierController@viewEdit');
    Route::post('/supplier/update', 'SupplierController@update');
    Route::get('/supplier/{id}/delete', 'SupplierController@destroy');
    Route::get('/supplier/manage', 'SupplierController@viewManage');


    Route::get('/menu/create', [App\Http\Controllers\MenuController::class, 'viewCreate']);
    Route::get('/supplier/{id}/delete', [App\Http\Controllers\SupplierController::class, 'destroy']);
    Route::post('/menu/store', 'MenuController@store');
    Route::get('/menu/{id}/edit', 'MenuController@viewEdit');
    Route::post('/menu/update', 'MenuController@update');
    Route::get('/menu/{id}/delete', 'MenuController@destroy');
    Route::get('/menu/manage', 'MenuController@viewManage');

    Route::post('/ingredients/store', [App\Http\Controllers\MenuMaterialController::class, 'store']);
    Route::get('/ingredients/{id}/delete', [App\Http\Controllers\MenuMaterialController::class, 'destroy']);


    Route::prefix('inbound')->group(function () {
        Route::get('/create', [App\Http\Controllers\InboundController::class, 'viewCreate']);
        Route::get('/{id}/cancel', 'InboundController@cancel');
        Route::post('/store', 'InboundController@store');
        Route::get('/{id}/edit', 'InboundController@viewEdit');
        Route::post('/update', 'InboundController@update');
        Route::get('/{id}/delete', 'InboundController@destroy');
        Route::get('/report', 'InboundController@viewManage');
        Route::get('/manage', 'InboundController@viewManage');
        Route::get('/input-daily', 'InboundController@viewInputDaily');
        Route::get('/daily-input', 'InboundController@viewInputDaily');
        Route::post('/daily-input/store', 'InboundController@storeDaily');
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
