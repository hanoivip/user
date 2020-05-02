<?php

namespace Hanoivip\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQna extends FormRequest
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
            'oldquestion' => 'string|current_secure_question',
            'oldanswer' => 'string|current_secure_answer',
            'newquestion' => 'required|string',//different:oldpass2
            'newanswer' => 'required|string',
            'captcha' => 'required|string|captcha'
        ];
    }
}
