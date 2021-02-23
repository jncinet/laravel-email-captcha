<?php

namespace Jncinet\EmailCaptcha\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:users,username'],
        ];
    }

    public function attributes()
    {
        return ['email' => trans('email-captcha::email_captcha.email')];
    }
}