<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\Authentication\LoginController;
use Modules\Customer\Http\Controllers\Authentication\Password\ForgotController;
use Modules\Customer\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('customer::page.home');
    })->name('index');
    Route::get('customer/create', [UserController::class, 'create'])->name('create');
    Route::post('customer/create', [UserController::class, 'store'])->name('store.create');
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');
    Route::group(['prefix' => 'password'], function () {
        Route::get('forgot', [ForgotController::class, 'show'])->name('password.forgot');
        Route::post('send', [ForgotController::class, 'send'])->name('password.send');
        Route::get('token/{token}', [ForgotController::class, 'token'])->name('password.token');
        Route::post('reset', [ForgotController::class, 'reset'])->name('password.reset');
        Route::get('complete', [ForgotController::class, 'complete'])->name('password.complete');
    });
});

Route::group(['middleware' => ['auth:customer', 'auth.session']], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    //団体管理者画面
    Route::get('home', [UserController::class, 'home'])->name('home');
});
