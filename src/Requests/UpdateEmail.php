<?php

namespace Hanoivip\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmail extends FormRequest
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
            'email' => 'required|string|email',
            //'email' => 'required|string|email|not_current_email|not_too_fast:300',
            //'captcha' => 'required|string|captcha'
        ];
    }
    
    public function messages()
    {
        return [
            'email' => 'Email validation fail..',
            'not_current_email' => 'You have to use another email..',
            'not_too_fast' => 'You have to wait 5 minutes from the last update',
        ];
    }
}
