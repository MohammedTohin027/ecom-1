<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\User\UserController;

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

Route::get('/', [FrontendController::class, 'index']);

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin'] ], function(){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    //  category route
    Route::prefix('category')->group(function () {
        Route::get('view', [CategoryController::class, 'view'])->name('category.view');
        Route::post('store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('active/{id}', [CategoryController::class, 'active'])->name('category.active');
        Route::get('inactive/{id}', [CategoryController::class, 'inactive'])->name('category.inactive');
    });
    //  brand route
    Route::prefix('brand')->group(function () {
        Route::get('view', [BrandController::class, 'view'])->name('brand.view');
        Route::post('store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('update/{id}', [BrandController::class, 'update'])->name('brand.update');
        Route::get('delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
        Route::get('active/{id}', [BrandController::class, 'active'])->name('brand.active');
        Route::get('inactive/{id}', [BrandController::class, 'inactive'])->name('brand.inactive');
    });

});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user'] ], function(){
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');