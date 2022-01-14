<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
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
     //  sub-category route
     Route::prefix('sub-category')->group(function () {
        Route::get('view', [SubCategoryController::class, 'view'])->name('sub-category.view');
        Route::get('create', [SubCategoryController::class, 'create'])->name('sub-category.create');
        Route::post('store', [SubCategoryController::class, 'store'])->name('sub-category.store');
        Route::get('edit/{id}', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
        Route::post('update/{id}', [SubCategoryController::class, 'update'])->name('sub-category.update');
        Route::get('delete/{id}', [SubCategoryController::class, 'delete'])->name('sub-category.delete');
        Route::get('active/{id}', [SubCategoryController::class, 'active'])->name('sub-category.active');
        Route::get('inactive/{id}', [SubCategoryController::class, 'inactive'])->name('sub-category.inactive');
    });

});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user'] ], function(){
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');