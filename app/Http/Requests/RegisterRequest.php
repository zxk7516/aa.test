<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:5|username|keep_word|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '用户名',
            'email'    => '邮箱',
            'password' => '密码'
        ];
    }
    
}
