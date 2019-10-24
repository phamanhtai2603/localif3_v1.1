<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
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
            

            'name'     => ['required', 
                            'unique:location','min:2',
            ],

            'sign'          => ['required',
                                'unique:location',
            ],

            'status'        => 'regex:/[0-1]{1}/',

            'image'        => 'image',

        ];
    }
    public function messages()
    {
        return [
            
            'name.unique'       => 'Tên địa điểm đã được sử dụng',
            'name.required'        => 'Tên địa điểm không được để trống',
            'name.min'           => 'Tên địa điểm phải lớn hơn 2 ký tự',

            'sign.required'          =>'Ký hiệu địa điểm không được để trống',
            'sign.unique'         => 'Ký hiệu địa điểm đã được sử dụng',

            'status.regex'      =>'Lỗi trạng thái',

            'image'             =>'Ảnh sai định dạng',
        ];
    }
}
