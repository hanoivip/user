<?php

namespace Hanoivip\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecureEmail extends FormRequest
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
            'personid' => 'string|current_secure_pid',
            'phone' => 'string|current_secure_phone',
            'oldmail' => 'string|email|current_secure_email',
            'newmail' => 'required|string|email',
            'captcha' => 'required|string|captcha'
        ];
    }
}
