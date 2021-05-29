<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);
namespace App\GatewayWorker;
use App\GatewayWorker\Service\Message;
use GatewayWorker\Lib\Gateway;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
    public static function onWebSocketConnect($client_id, $data)
    {
        if (!isset($data['get']['token']) || empty($data['get']['token']))
        {
            Gateway::closeClient($client_id,"{'message':'token 空'}");
            return;
        }

        $token = $data['get']['token'];
        $user = Cache::get("lar-chat:token:$token");
//        var_dump($user);

        Gateway::bindUid($client_id,"user-{$user->id}");


    }
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     *
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
        $user_id = Gateway::getUidByClientId($client_id);
        // 向当前client_id发送数据
        Gateway::sendToClient($client_id,ws_json('init','连接成功'.$user_id));
    }

    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param mixed $message 具体消息
     */
    public static function onMessage($client_id, $message)
    {
        if ($message == '')
        {
            echo "消息空\n";
            return;
        }
        if (!$messageArr = json_decode($message,true))
        {
            echo "消息不为JSON\n";
            return;
        }

        if (!check_jiami($messageArr))
        {
            echo "halt 有误\n";
            return;
        }
        if ($messageArr['event'] == 'user.message')
        {
            echo "user.message\n";
            Message::notify($messageArr['from_id'],$messageArr['to_id']);
        }
    }

    /**
     * 当用户断开连接时触发
     * @param int $client_id 连接id
     */
    public static function onClose($client_id)
    {
        Log::info('close connection' . $client_id);

    }
}
