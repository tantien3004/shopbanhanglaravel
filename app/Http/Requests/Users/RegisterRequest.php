<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'email' => 'required|max:255',
            'password' => 'required|min:5',
            'name' => 'required|max:255',
            'phone' => 'required|max:11, min:9',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'password.required' => 'Password is required!',
            'password.min' => 'Password is too short',
            'phone.max' => 'Số điện thoại không tồn tại',
            'phone.min' => 'Số điện thoại không tồn tại'
        ];
    }
}
