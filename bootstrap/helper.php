<?php

    function helper(){
        return "helper";
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
