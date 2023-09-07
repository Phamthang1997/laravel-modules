<?php

use Illuminate\Support\Facades\Route;
use Modules\Mobile\Http\Controllers\Authentication\LoginController;
use Modules\Mobile\Http\Controllers\Authentication\Password\ForgotController;
use Modules\Mobile\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['guest']], function () {
    Route::group(['prefix' => 'login'], function () {
        Route::post('/', [LoginController::class, 'authenticate']);
        Route::post('refresh-token', [LoginController::class, 'refreshToken']);
    });
    Route::group(['prefix' => 'password'], function () {
        Route::post('forgot', [ForgotController::class, 'forgot'])->name('password.forgot');
        Route::post('verify', [ForgotController::class, 'verify'])->name('password.verify');
        Route::post('reset', [ForgotController::class, 'reset'])->name('password.reset');
    });
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', [UserController::class, 'profile']);
});
