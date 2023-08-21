<?php

use Illuminate\Support\Facades\Route;
use Modules\Administrator\Http\Controllers\Authentication\LoginController;
use Modules\Administrator\Http\Controllers\UserController;

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
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/show', [UserController::class, 'show']);
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => ['auth:administrator', 'auth.session']], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    //団体管理者画面
    Route::get('/home', [UserController::class, 'home'])->name('home');
});
