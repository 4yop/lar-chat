<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFriend extends Model
{
    public function friend()
    {
        return $this->hasOne(User::class,'id','friend_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
