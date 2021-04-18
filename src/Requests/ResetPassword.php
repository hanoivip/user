<?php

namespace Hanoivip\User\Requests;

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
            'resettoken' => 'required|string',
        ];
    }
}
