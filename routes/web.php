<?php

use App\Http\Controllers\Admin\AdminController;
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
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user'] ], function(){
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
