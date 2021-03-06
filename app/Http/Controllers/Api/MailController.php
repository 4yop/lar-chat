<?php

namespace App\Http\Controllers\Api;

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
        $to_mail = $request->email;
        try {
            Mail::to($to_mail)->later(time() + 1, new RegisterCode($to_mail));
        }catch (EmailException $e){
            throw new EmailException($e->getMessage());
        }
        return success_json('发送邮件验证码成功');
    }
}
