<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatList extends Model
{
    use HasFactory;

    public function otherUser()
    {
        return $this->hasOne(User::class,'id','other_id');
    }
    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s',strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        $timestamp = strtotime($value);
        $time = time();

        /**
         * 1、当天的消息，以每5分钟为一个跨度的显示时间；
            2、消息超过1天、小于1周，显示星期+收发消息的时间；
            3、消息大于1周，显示手机收发时间的日期。
         */
        if ( date('Y-m-d',$time) == date('Y-m-d',$timestamp) )
        {
            return date('H:i',$timestamp);
        }
        else if ($time - $timestamp > 24*60*60*7)
        {
            return date('h/i/s',$timestamp);
        }

        return date('H:i',strtotime($value));
        //return date('Y-m-d H:i:s',strtotime($value));
    }

}
