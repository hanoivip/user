<?php

namespace Hanoivip\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'oldpass' => 'required|string|current_password',
            'newpass' => 'required|string|confirmed',//noteasy
            'captcha' => 'required|string|captcha'
        ];
    }
}
