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
            'newpass' => 'required|string|min:8|confirmed',
            'token' => 'required|string',
        ];
    }
}
