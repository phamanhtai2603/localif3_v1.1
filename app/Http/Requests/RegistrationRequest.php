<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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

            'email'     => 'required|email|unique:users,email',

            'password'  => [
                'required',
                'min:6',
                'max:16',
            ],
        ];
    }
    public function messages()
    {
        return [

            'email.required'        => 'Email không được để trống',
            'email.email'           => 'Email không hợp lệ',
            'email.unique'          => 'Email đã được đăng ký',

            'password.required'     => 'Mật khẩu không được để trống',
            'password.min'          => 'Mật khẩu quá ngắn',
            'password.max'          => 'Mật khẩu quá dài',
        ];
    }
}
