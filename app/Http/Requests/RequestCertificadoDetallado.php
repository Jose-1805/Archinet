<?php

namespace Archinet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCertificadoDetallado extends FormRequest
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
            //'destinatario'=>'required|email|min:5|max:150',
            'asunto'=>'required|min:3|max:250',
            'descripcion'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'destinatario.required'=>'Debe escribir un email de destinatario',
            'destinatario.email'=>'Dirección de correo no válida',
            'destinatario.min'=>'El campo debe contener al menos 5 caracteres',
            'destinatario.max'=>'Este campo no permite más de 150 caracteres',

            'asunto.required'=>'Debe escribir un asunto',
            'asunto.min'=>'El campo debe contener al menos 3 caracteres',
            'asunto.max'=>'Este campo no permite más de 250 caracteres',

            'descripcion.required'=>'Debe escribir una descripción',
        ];
    }
}
