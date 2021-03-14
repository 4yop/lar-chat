<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\CheckRegisterCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->is('*/user/register')) {
            return $this->register_rules();
        }elseif ($this->is('*/user/login')){
            return $this->login_rules();
        }


    }

    public function login_rules()
    {
        $function = function ($attribute,$value,$fail) {
            $user = User::where('email',$this->email)->first();
            if (!Hash::check($value,$user->password)) {
                return $fail('密码有误');
            }
            $this->user = $user;
        };
        return [
            'email'    => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'between:6,18',
                $function
            ],
        ];
    }

    public function register_rules()
    {

        return [
            'email'      => [
                'required',
                'email',
                !Rule::exists('users','id')->where('email',$this->email),
                ],
            'password'   => 'required|between:6,18',
            'repassword' => 'required|same:password',
            'code' => [
                'required',
                new CheckRegisterCode( $this->input('email') )
            ],
        ];
    }

    public function login ()
    {

    }


    public function attributes()
    {
        return [
            'code' => '邮箱验证码'
        ];
    }
}
