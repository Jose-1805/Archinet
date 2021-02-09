<?php

namespace Archinet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestGestionTipoDocumental extends FormRequest
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
            'nombre' => 'required|min:4|max:150|unique:tipos_documentales,nombre,' . $this->id . ',id',
            'seccion' => 'required|exists:secciones,id'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Debe escribir un nombre',
            'nombre.max' => 'Esté campo no permite más de 150 caracteres ',
            'nombre.min' => 'El campo nombre debe contener al menos 4 caracteres',
            'nombre.unique' => 'El tipo documental: "'.$this->nombre.'" ya existe',

            'seccion.required'=>'Debe seleccionar una sección para el tipo documental',
            'seccion.exists' => 'Debe seleccionar una sección para el tipo documental'


        ];
    }
}
