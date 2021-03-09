<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailException;
use App\Http\Requests\MailRequest;
use App\Mail\RegisterCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendRegisterCode(MailRequest $request)
    {



        $to_mail = $request->input('email');

        if (!$to_mail)
        {
            return  error_json('邮箱呢');
        }

        if ( User::where('email',$to_mail)->first())
        {
            return  error_json('该邮箱已注册');
        }



        try {
            Mail::to($to_mail)->later(time() + 1, new RegisterCode($to_mail));
        }catch (EmailException $e){
            throw new EmailException($e->getMessage());
        }
        return success_json('发送邮件验证码成功');
    }
}
