<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MachineRequest extends FormRequest
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
            'machine_name' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'machine_name.required' => 'Vui lòng nhập vào machine name',
            'machine_name.unique' => 'Machine name đã tồn tại, vui lòng nhập name khác.',
            
        ];
    }
}
