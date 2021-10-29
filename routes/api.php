<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/test', [UserController::class, 'test'])->name('test');

    Route::middleware('api.guard')->group(function () {
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
        Route::post('/login',[LoginController::class, 'login'])->name('users.login');
        Route::middleware('token.refresh')->group(function () {
            Route::get('/users', [UserController::class, 'index']);
            Route::get('/me',[UserController::class, 'me'])->name('users.me');
            Route::get('/users/{user}', [UserController::class, 'show']);

            Route::post('/logout',[LogoutController::class, 'logout'])->name('users.logout');
        });
    });


    Route::middleware('admin.guard')->group(function () {
        Route::post('/admin_register', [RegisterController::class, 'adminRegister'])->name('admin.register');
        Route::post('/admin_login',[LoginController::class, 'adminLogin'])->name('admins.login');
        Route::middleware('token.refresh')->group(function () {
            Route::get('/admins', [AdminController::class, 'index']);
            Route::get('/admin_me',[AdminController::class, 'me'])->name('admins.me');
            Route::get('/admins/{admin}', [AdminController::class, 'show']);

            Route::post('/admin_logout',[LogoutController::class, 'adminLogout'])->name('admins.logout');
        });
    });



});
