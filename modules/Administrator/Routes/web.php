<?php

use Illuminate\Support\Facades\Route;
use Modules\Administrator\Http\Controllers\Authentication\LoginController;
use Modules\Administrator\Http\Controllers\Authentication\Password\ForgotController;
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
    Route::get('/', function () {
        return view('administrator::authentication.login');
    })->name('index');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
    Route::get('/show', [UserController::class, 'show']);
    Route::group(['prefix' => 'password'], function () {
        Route::get('forgot', [ForgotController::class, 'show'])->name('password.forgot');
        Route::post('send', [ForgotController::class, 'send'])->name('password.send');
        Route::get('token/{token}', [ForgotController::class, 'token'])->name('password.token');
        Route::post('reset', [ForgotController::class, 'reset'])->name('password.reset');
        Route::get('complete', [ForgotController::class, 'complete'])->name('password.complete');
    });
});

Route::group(['middleware' => ['auth:administrator', 'auth.session']], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    //団体管理者画面
    Route::get('/home', [UserController::class, 'home'])->name('home');
});
