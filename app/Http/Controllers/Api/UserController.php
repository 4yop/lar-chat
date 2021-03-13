<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function register(UserRequest $request)
    {
        $data = $request->input();
        return success_json('ok',$data);
    }
}
