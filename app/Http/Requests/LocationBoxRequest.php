<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationBoxRequest extends FormRequest
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
            'lb_name' => 'required|max:255',
            'lb_location_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'lb_name.required' => 'Vui lòng nhập vào ô vị trí',
            'lb_name.max' => 'Ô vị trí vượt quá số ký tự cho phép',
            'lb_location_id.required' => 'Vui lòng chọn vị trí',
        ];
    }
}
