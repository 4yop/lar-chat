<?php

namespace App\Exceptions;

use Exception;

class UserException extends ApiException
{
    protected $message = '用户相关有误';
}
