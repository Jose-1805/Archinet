<?php

namespace Archinet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfiguracionCorreosRequest extends FormRequest
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
            'correo_solicitud_certificados'=>'required|min:5|max:150|email',
        ];
    }

    public function messages(){
        return[
            'correo_solicitud_certificados.required'=>'Debe escribir un correo',
            'correo_solicitud_certificados.min'=>'El campo campo debe contener al menos 5 caracteres',
            'correo_solicitud_certificados.max'=>'Este campo no permite más de 150 caracteres',
            'correo_solicitud_certificados.email'=>'Dirección de correo no válida',
        ];
    }
}
