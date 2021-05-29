<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MailController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressBookController;
use App\Http\Controllers\Api\FriendController;
use App\Http\Controllers\Api\ChatController;

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

            Route::get('friends',[FriendController::class,'index'])->name('friend.index');

            Route::get('friend/search',[FriendController::class,'getByEmail'])->name('friend.search');

            Route::get('friend/{friend_id}',[FriendController::class,'detail'])->where('friend_id', '[0-9]+')->name('friend.index');

            Route::post('friend/add',[FriendController::class,'add'])->name('friend.add');


            Route::get('chat/{friend_id}',[ChatController::class,'index'])->where('friend_id', '[0-9]+')->name('chat.index');

            Route::post('send/friend',[ChatController::class,'toUser'])->name('chat.send');

            Route::get('chat/list',[ChatController::class,'chatList'])->name('chat.list');

            Route::post('chat/hide',[ChatController::class,'hideList'])->name('chat.hide');


        });

        Route::get('/user/list',[AddressBookController::class,'index'])->name('address_book.index');
    });
