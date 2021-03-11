<?php

namespace App\Http\Requests;

use App\Exceptions\EmailException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
class MailRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {

        throw new EmailException($validator->errors()->first());

    }

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
            'email' => 'required|email',
        ];
    }
}
