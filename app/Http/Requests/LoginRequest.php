<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'geetest_challenge' => 'geetest',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'geetest' => config('laravel-geetest.client_fail_alert')
        ];
    }
}
