<?php

namespace Hanoivip\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'newpass' => 'required|string|confirmed',
            'captcha' => 'required|string|captcha'
        ];
    }
}
