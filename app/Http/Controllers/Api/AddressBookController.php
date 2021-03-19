<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AddressBookController extends Controller
{
    //通讯录
    public function index()
    {
       $data = User::all(['id','name','email']);
        return success_json('ok',$data);
    }


}
