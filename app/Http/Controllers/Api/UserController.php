<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{

    public function register(UserRequest $request)
    {
        $res = User::insertGetId([
                    'name' => '随机名字',
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
        if (!$res)
        {
            throw new UserException('注册失败');
        }

        return success_json('注册成功');
    }

    public function login (UserRequest $request)
    {

        if ( !$token = Auth::guard('api')->login($request->user) )
        {
            throw new UserException('登录失败');
        }

        return success_json('登录成功',[
            'token' => $token,
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function show(User $user, Request $request)
    {
        $data = [
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ];
        return success_json('ok',$data);
    }

    public function logout()
    {

        auth('api')->logout();
        return success_json('退出登录');
    }

}
