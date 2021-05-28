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


        $friend = User::where(['id'=>$friend_id])->first();
        if ($friend) {
            $friend['is_friend'] = UserFriend::where(['user_id' => $user->id, 'friend_id' => $friend_id])->exists() ? 1 : 0;
        }

        return success_json('ok',$friend);
    }

    public function getByEmail(Request $request)
    {
        $user = $request->user();
        $email = $request->input('email');
        $friend = User::where(['email'=>$email])->first();
        if (!$friend)
        {
            return error_json('查无此人');
        }
        $friend['is_friend'] = UserFriend::where(['user_id' => $user->id, 'friend_id' => $friend->id])->exists() ? 1 : 0;
        return success_json('ok',$friend);
    }

}
