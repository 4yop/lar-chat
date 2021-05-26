<?php


namespace App\Http\Controllers\Api;



use App\Models\UserFriend;
use Illuminate\Http\Request;
use App\Models\User;

class FriendController
{
    public function index(Request $request)
    {
        $user = $request->user();
        $list = UserFriend::with(['friend'])->where('user_id',$user->id)->get();

        return success_json('ok',[
            'list' => $list,
        ]);
    }
}
