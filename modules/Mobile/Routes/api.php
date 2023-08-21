<?php

use Illuminate\Support\Facades\Route;
use Modules\Mobile\Http\Controllers\Authentication\LoginController;
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
Route::group(['prefix' => 'login'], function () {
    Route::post('/', [LoginController::class, 'authenticate']);
    Route::post('refresh-token', [LoginController::class, 'refreshToken']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', [UserController::class, 'profile']);
});
