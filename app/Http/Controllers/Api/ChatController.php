<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatList;
use App\Models\UserFriend;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //和某个好友的聊天记录
    public function index(int $friend_id,Request $request)
    {
        $user = $request->user();

        $unique_id = chat_unique_id($friend_id,$user->id);

        $chat = Chat::where(['unique_id'=>$unique_id])
                    ->with(['fromUser'])
                    ->orderBy('id','desc')
                    ->simplePaginate(20)
                    ->toArray();
                if ($request->input('page') == 1)
                {
                    Chat::where(['from_id' => $friend_id, 'to_id' => $user->id])->update(['status' => Chat::READ]);
                    ChatList::where(['user_id'=>$user->id,'other_id'=>$friend_id,'type'=>0])->update(['no_read'=>0]);
                }
        $chat['data'] = array_reverse($chat['data']);
        return success_json('ok',$chat['data']);
    }

    //发消息给好友
    public function toUser(Request $request,Chat $chat)
    {
        $user = $request->user();
        $friend_id = $request->input('friend_id',0);
        $content = $request->input('content','');
        if ($friend_id < 1 )
        {
            return error_json('好友id有误');
        }
        if ($content == '')
        {
            return error_json('发送内容为空');
        }
        if (UserFriend::where(['user_id'=>$user->id,'friend_id'=>$friend_id])->doesntExist())
        {
            return error_json('不是你的好友了');
        }
        $unique_id = chat_unique_id($friend_id,$user->id);



        $chat->from_id = $user->id;
        $chat->to_id = $friend_id;
        $chat->unique_id = $unique_id;
        $chat->content = $content;
        $chat->type = Chat::TEXT;
        $chat->save();

        if ($chat->save())
        {
            $data = jiami([
                        'event'  =>'user.message',
                        'chat_id'=>$chat->id,
                        'to_id'=>$friend_id,
                        'from_id'=>$user->id
                    ]);
            return success_json('发送成功',$data);
        }
        return error_json('发送失败');
    }

    //聊天列表
    public function chatList(Request $request)
    {
        $user = $request->user();
        $chat = ChatList::where(['user_id'=>$user->id,'is_show'=>1])
                        ->with(['otherUser'])
                        ->orderBy('updated_at','desc')
                        ->simplePaginate(20)
                        ->toArray();


        return success_json('发送成功',$chat['data']);
    }

    public function hideList(Request $request)
    {
        $user = $request->user();
        $id = (int)$request->input('id',0);
        if ($id < 1)
        {
            return error_json('操作失败');
        }
        ChatList::where(['user_id'=>$user->id,'id'=>$id,'is_show'=>1])->update(['is_show'=>0]);
        return success_json('操作完成');
    }

}
