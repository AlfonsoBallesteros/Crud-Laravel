<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'tecno'=>'required'
        ];
    }
    public function messages()
    {
        return [
            
            'name.required'   => 'El nombre es obligatorio.',

            'tecno.required'   => 'La Tecnologia es obligatorio.',
        ];
    }
}