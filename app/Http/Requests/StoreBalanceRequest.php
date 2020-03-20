<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBalanceRequest extends FormRequest
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
            
            'balance'  => 'regex:/[0-9]/|max:8|nullable',
        ];
    }
    
    public function messages()
    {
        return [
            
            'balance.regex'       => 'Chỉ nhập được ký tự từ 0 đến 9',
            'balance.max'       => 'Số tiền tối đa là 100 triệu',
        ];
    }
}
