<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class ApiException extends Exception
{
    protected $message = 'API Exception';
    public function __construct($message, int $code = 403)
    {
        if ($message != '') {
            $this->message = $message;
        }
        parent::__construct($message, $code);
    }

    // 当这个异常被触发时，会调用 render 方法来输出给用户
    public function render(Request $request)
    {
        return error_json($this->message);
    }
}
