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

    public function detail(Request $request)
    {
        $user = $request->user();
        $firend_id = $request->input('firend_id');
        $list = UserFriend::with(['friend'])->where(['user_id'=>$user->id,'firend_id'=>$firend_id])->first();
    }

}
