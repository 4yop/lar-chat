<?php


namespace App\GatewayWorker\Service;

use GatewayWorker\Lib\Gateway;

class Message
{
    public static function notify(int $from_id,int $to_id):bool
    {
        $uid = "user-{$to_id}";
        if ( !Gateway::isUidOnline($uid) )
        {
            echo "user-{$to_id}不在线\n";
            return false;
        }
        $message = json_encode([
            'event' => 'user.message',
            'from_id' => $from_id,
        ]);
        Gateway::sendToUid($uid,$message);
        return true;
    }
}
