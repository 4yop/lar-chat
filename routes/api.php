<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MailController;
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
        });
    });
