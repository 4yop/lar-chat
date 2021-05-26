<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MailController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressBookController;
use App\Http\Controllers\Api\FriendController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test',[\App\Http\Controllers\Test::class,'sendEmail']);




Route::prefix('v1')
    ->name('api.v1.')
    ->namespace('Api')
    ->middleware('throttle:60,1')
    ->group(function () {
        // 邮箱验证码发送
        Route::post('/register/code',[MailController::class,'sendRegisterCode'])->name('register.code');


        Route::post('/user/register',[UserController::class,'register'])->name('user.register');

        Route::post('/user/login',[UserController::class,'login'])->name('user.login');


        // 登录后可以访问的接口
        Route::middleware('auth:api')->group(function() {
            Route::get('user', [UserController::class, 'show'])->name('user.show');
            Route::post('logout', [UserController::class, 'logout'])->name('user.logout');

            Route::get('friend',[FriendController::class,'index'])->name('user.logout');

        });

        Route::get('/user/list',[AddressBookController::class,'index'])->name('address_book.index');
    });
