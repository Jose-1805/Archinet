<?php

namespace Archinet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRol extends FormRequest
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
        if ($this->has('rol')) {
            return [
                'nombre' => 'required|regex:/[A-Za-z ñ]/|min:3|max:45|unique:roles,nombre,' . $this->rol . ',id',
                //'privilegios'=>'required'
            ];
        } else {
            return [
                'nombre' => 'required|regex:/[A-Za-z ñ]/|min:3|max:45|unique:roles,nombre',
                //'privilegios'=>'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'nombre.max' => 'Esté campo no permite más de 45 caracteres ',
            'nombre.required' => 'Debe escribir el nombre',
            'nombre.unique' => 'EL rol ya se encuentra registrado'


        ];
    }
}
