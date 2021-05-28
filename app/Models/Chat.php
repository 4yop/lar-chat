<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    const TEXT = 0;

    const msgType = [
        self::TEXT => '文字',
    ];

    const READ = 1;
    const NO_READ = 0;
    const STATUS = [
        self::READ => '已读',
        self::NO_READ => '未读',
    ];

    public function fromUser()
    {
        return $this->hasOne(User::class,'id','from_id');
    }


    /**
     * 模型的 "booted" 方法
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($chat) {
            $chatList1 = ChatList::where(['user_id'=>$chat->from_id,'other_id'=>$chat->to_id,'type'=>0])
                                 ->first();
            if (!$chatList1)
            {
                $chatList1 = new ChatList();
            }
            $chatList1->last_content = $chat->content;
            $chatList1->user_id = $chat->from_id;
            $chatList1->other_id = $chat->to_id;
//            $chatList1->no_read = isset($chatList1->no_read)?$chatList1->no_read+1:1;
            $chatList1->save();



            $chatList2 = ChatList::where(['user_id'=>$chat->to_id,'other_id'=>$chat->from_id,'type'=>0])
                                 ->first();
            if (!$chatList2)
            {
                $chatList2 = new ChatList();
            }
            $chatList2->last_content = $chat->content;
            $chatList2->user_id = $chat->to_id;
            $chatList2->other_id = $chat->from_id;
            $chatList2->no_read = isset($chatList1->no_read)?$chatList1->no_read+1:1;
            $chatList2->save();
        });
    }

}

