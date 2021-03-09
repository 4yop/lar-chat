<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterCode;
class Test extends Controller
{
    //
    public function sendEmail()
    {
        $to_mail = "1131559748@qq.com";
        try {
            Mail::to($to_mail)->later(time() + 1, new RegisterCode($to_mail));
        }catch (EmailException $e){
            throw new EmailException($e->getMessage());
        }
        return success_json('发送邮件验证码成功');
    }
}
