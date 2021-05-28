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

    public function detail(int $friend_id,Request $request)
    {
        $user = $request->user();

        $friend = UserFriend::with(['friend'])->where(['user_id'=>$user->id,'friend_id'=>$friend_id])->first();
        return success_json('ok',$friend['friend']);
    }



}
