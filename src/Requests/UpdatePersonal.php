<?php

namespace Hanoivip\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonal extends FormRequest
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
            'hoten' => 'required|string',
            'sex' => 'required|integer',
            'birthday' => 'required|date',
            'city' => 'required|integer',
            'address' => 'required|string',
            'career' => 'required|string',
            'marriage' => 'required|integer',
            'captcha' => 'required|captcha'
        ];
    }
}
