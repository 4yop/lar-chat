<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'email' => 'require',
            'password' => 'require',
            'repassword' => 'require',
            'code' => 'require',
        ];
    }

    public function attributes()
    {
        return [
            'code' => '邮箱验证码'
        ];
    }
}
