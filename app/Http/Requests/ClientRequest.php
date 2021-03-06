<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'avatar'=>'mimes:png,jpeg|max:2048',
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|max:11',
            'id_skill'=>'required'
        ];
    }

    public function messages()
    {
        return [

            'avatar.mimes' => 'Se requiere una imagen',
            'avatar.max' => 'La imagen es muy grande',
            
            'name.required'   => 'El name es obligatorio.',

            'email.required'    => 'El email es obligatorio.',
            'email.email'       => 'El email debe ser un correo válido.',

            'phone.required'   => 'El Telefono es obligatorio.',
            'phone.max'   => 'El Telefono no puede ser mayor a 11.',

            'id_skill.required' => 'el skill es obligatorio'
        ];
    }
}
