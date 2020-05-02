<?php

namespace Hanoivip\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePass2 extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'personid' => 'string|current_secure_pid',
            'oldpass2' => 'string|current_secure_pass2',
            'newpass2' => 'required|string|confirmed',//different:oldpass2
            'captcha' => 'required|string|captcha'
        ];
    }
}
