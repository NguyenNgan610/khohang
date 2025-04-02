<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductWarehousingDetailRequest extends FormRequest
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
            //
            'pwd_location_id' => 'required',
            'pwd_box_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'p_location_id.required' => 'Dữ liệu không được phép để trống',
            'pwd_box_id.required' => 'Dữ liệu không được phép để trống',
        ];
    }
}
