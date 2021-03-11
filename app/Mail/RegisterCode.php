<?php

namespace App\Mail;

use App\Exceptions\EmailException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class RegisterCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $to_email;

    protected $key;
    public function __construct($to_email)
    {
        $this->to_email = $to_email;
        $this->key = "register_email:{$this->to_email}";
//        if (!$this->isCanSend()) {
//            throw new EmailException('该邮箱请5分钟后再发');
//        }
    }

    //生成 4位数字的注册码
    public function createRegisterCode(int $length = 4) : string
    {
        $code = '';
        for ($i = 0;$i < $length; $i++)
        {
            $code .= mt_rand(0,9);
        }
        $this->setExpireTime($code);
        return $code;
    }

    //验证码
    public function getCodeByEmail()
    {
        return Cache::get($this->key);
    }

    //是否能发
    public function isCanSend()
    {
        if ( $this->getCodeByEmail() )
        {
            return false;
        }
        return true;
    }


    //
    public function setExpireTime($code,int $seconds = 300)
    {
        Cache::put($this->key, $code, $seconds);
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $code = $this->createRegisterCode();
        return $this->view('email.register_code',['code'=>$code])->subject("注册验证码:{$code}");
    }
}
