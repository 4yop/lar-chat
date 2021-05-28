<?php

    function helper(){
        return "helper";
    }

    /**生成聊天的unique_id
     * @param int $user_id
     * @param int $friend_id
     * @return string
     */
    function chat_unique_id(int $user_id_1,int $user_id_2)
    {
        if ($user_id_1 > $user_id_2)
        {
            return "{$user_id_2}-{$user_id_1}";
        }
        return "{$user_id_1}-{$user_id_2}";
    }

    function success_json($msg='',$data=[])
    {
        return res_json(1,$msg,$data);
    }

    function error_json($msg='',$data=[])
    {
        return res_json(0,$msg,$data);
    }



    function res_json($code,$msg='',$data=[])
    {
        return response()->json(compact('code','msg','data'));
        //return json_encode(compact('code','msg','data'));
    }

    function ws_json(string $type,string $msg,array $data = [])
    {
        return json_encode([
            'type'=> $type,
            'msg' => $msg,
            'data' => $data,
        ]);
    }

    function halt(string $string)
    {
        $halt = 'dsjfodp;dfgjkdfgkljsdfhksdf';
        return md5($string.$halt);
    }

    function jiami(array $array = []):array
    {
        if (isset($array['halt']))
        {
            throw new Exception("不准带 halt 键");
        }
        $array[uniqid()] = uniqid();
        $array['timestamp'] = time();
        $halt =  jia($array);
        $array['halt'] = $halt;
        return $array;
    }

    function check_jiami(array $array = []):bool
    {
        if (!isset($array['halt']) || empty($array['halt']))
        {
            echo "没halt\n";
            return false;
        }


        if (!isset($array['timestamp']) || empty($array['timestamp']) || $array['timestamp'] < time() - 15 )
        {
            echo "timestamp 有误\n";
            return false;
        }
        $halt = $array['halt'];
        unset($array['halt']);
        return $halt == jia($array);
    }

    function jia(array $array = []):string
    {
        krsort($array);
        $str = '';
        foreach ($array as $key => $val)
        {
            $str.= "{$key}=$val&";
        }
        $halt = md5($str."fghksdhfk");
        return $halt;
    }
