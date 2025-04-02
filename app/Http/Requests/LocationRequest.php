<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'l_name' => 'required | max:255 '
        ];
    }

    public function messages()
    {
        return [
            'l_name.required' => 'Vui lòng nhập vào vị trí',
            'l_name.max' => 'Vị trí vượt quá số ký tự cho phép',
        ];
    }
}
