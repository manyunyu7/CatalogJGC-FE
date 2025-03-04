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

Route::get('/detail/{cluster_slug}/{title_slug}', [App\Http\Controllers\ProductDetailController::class, 'show']);

Route::get("/user-info", [AuthController::class, 'getUserInfo']);

Route::post("/login-action", [AuthController::class, 'login'])->name('login-action');

Route::view("/login", 'auth/login')->name('login');
Route::view("/detail", 'catalog/detail');
Route::view("/detailjg", 'catalog/detailjg');

Route::get("/login", [AuthController::class, 'loginView']);

Route::get('/', [App\Http\Controllers\MyMainProfileController::class, 'index']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {


    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin']);
    Route::get('/staff', [App\Http\Controllers\HomeController::class, 'index']);


    Route::get("/inbox/manage", [App\Http\Controllers\MessageFromClientController::class, 'manage']);
    Route::post('/user/store', [App\Http\Controllers\StaffController::class, 'store']);
    Route::post('/user/update', [App\Http\Controllers\StaffController::class, 'update']);
    Route::get('/user/{id}/delete', [App\Http\Controllers\StaffController::class, 'destroy']);


    Route::middleware('auth')->group(function () {

        Route::get('/admin/user/create', [App\Http\Controllers\StaffController::class, 'viewAdminCreate']);
        Route::get('/admin/user/manage', [App\Http\Controllers\StaffController::class, 'viewAdminManage']);
        Route::get('/admin/user/{id}/edit', [App\Http\Controllers\StaffController::class, 'viewAdminEdit']);


        Route::prefix('cms-user')->group(function () {
            Route::get('manage-product-details/{parent_id}', [App\Http\Controllers\ManageProductDetailController::class, 'index'])->name('manage-product-details.index');
            Route::post('manage-product-details/{parent_id}', [App\Http\Controllers\ManageProductDetailController::class, 'storeOrUpdate'])->name('manage-product-details.storeOrUpdate');
            Route::delete('manage-product-details/{parent_id}', [App\Http\Controllers\ManageProductDetailController::class, 'destroy'])->name('manage-product-details.destroy');


            Route::get('product-images/{parentId}/manage', [App\Http\Controllers\ProductImageController::class, 'manageImages'])->name('product-images.manage');
            Route::post('product-images/{parentId}/upload', [App\Http\Controllers\ProductImageController::class, 'uploadImages'])->name('product-images.upload');
            Route::delete('product-images/{id}/delete', [App\Http\Controllers\ProductImageController::class, 'deleteImage'])->name('product-images.delete');
            Route::post('product-images/reorder', [App\Http\Controllers\ProductImageController::class, 'reorderImages'])->name('product-images.reorder');
        });


        Route::prefix('cms')->group(function () {

            Route::resource('fasilitas-transactions', FasilitasTransactionController::class);


            // /product/detail/{parentId}/{id}
            Route::prefix("manage-product")->group(function () {
                Route::get('/', [App\Http\Controllers\ManageProductController::class, 'viewManage']);
                Route::get('/edit/{parentId}/{id}/', [App\Http\Controllers\ManageProductController::class, 'viewEdit']);
                Route::post('/price/{parentId}/{id}/update', [App\Http\Controllers\ProductPriceController::class, 'updatePriceFe']);
                Route::post('/unit-facilities/{parentId}/{id}/update', [App\Http\Controllers\ManageProductController::class, 'updateFacility']);
            });


            Route::get('fasilitas', [App\Http\Controllers\FasilitasController::class, 'index'])->name('fasilitas.index');
            Route::get('fasilitas/create', [App\Http\Controllers\FasilitasController::class, 'create'])->name('fasilitas.create');
            Route::post('fasilitas/store', [App\Http\Controllers\FasilitasController::class, 'store'])->name('fasilitas.store');
            Route::get('fasilitas/edit/{id}', [App\Http\Controllers\FasilitasController::class, 'edit'])->name('fasilitas.edit');
            Route::put('fasilitas/{id}/update/', [App\Http\Controllers\FasilitasController::class, 'update'])->name('fasilitas.update');
            Route::get('fasilitas/{id}/destroy', [App\Http\Controllers\FasilitasController::class, 'destroy'])->name('fasilitas.destroy');
        });
    });


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




});


Route::get("/cariQuery", "CariQueryController@cari");


Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    // Clear the 'killaToken' cookie
    $cookie = cookie()->forget('killaToken');

    return Redirect::to('/')->withCookie($cookie);
})->name('logout');
