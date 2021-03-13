<?php

namespace App\Rules;

use App\Mail\RegisterCode;
use Illuminate\Contracts\Validation\Rule;

class CheckRegisterCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $email;
    protected $code;
    protected $val;
    public function __construct($email)
    {
        //
        $this->email = $email;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->code = (new RegisterCode($this->email))->getCodeByEmail();
        $this->val = $value;
        return $value == $this->code;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        //"{$this->code} != {$this->val}"
        return '邮箱验证码有误.';
    }
}
