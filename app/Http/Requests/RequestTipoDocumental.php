<?php

namespace Archinet\Http\Requests;

use Archinet\Models\TipoDocumental;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RequestTipoDocumental extends FormRequest
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
        $data = [
            'cantidad_folios'=>'required|numeric',
            'fecha_documento'=>'nullable|date|before_or_equal:'.date('Y-m-d'),
            'observaciones'=>'nullable',
            'descripcion'=>'nullable',
        ];

        //es creación de un documento
        if(!$this->has('documento')){
            $data['archivo'] = 'required|mimes:pdf';
        }else{//es la edición de un documento
            if(Auth::user()->esSuperadministrador()){
                $data['archivo'] = 'mimes:pdf';
            }

            unset($data['cantidad_folios']);
        }

        $tipo_documental = TipoDocumental::find($this->tipo_documental);
        //se buscan las validaciones para cada tipo documental
        if($tipo_documental){
            if(array_key_exists($tipo_documental->carpeta,config('params.validaciones_tipos_documentales')))
                $data += config('params.validaciones_tipos_documentales')[$tipo_documental->carpeta];
        }

        return $data;
    }

    public function messages()
    {
        $data = [
            'cantidad_folios.required'=>'Debe escribir la cantidad de folios',
            'cantidad_folios.numeric'=>'Sólo se permiten caracteres numéricos (0-9)',

            'fecha_documento.required'=>'Debe seleccionar la fecha del documento',

            'observaciones.max'=>'El campo no permite más de 150 caracteres',
            'observaciones.min'=>'El campo debe contener al menos 3 caracteres',

            'descripcion.max'=>'El campo no permite más de 200 caracteres',
            'descripcion.min'=>'El campo debe contener al menos 3 caracteres',

            'archivo.required'=>'Debe subir un archivo',
            'archivo.max'=>'Peso no permitido',
        ];

        $tipo_documental = TipoDocumental::find($this->tipo_documental);
        //se buscan los mensajes de validaciones para cada tipo documental
        if($tipo_documental){
            if(array_key_exists($tipo_documental->carpeta,config('params.mensajes_validaciones_tipos_documentales')))
                $data += config('params.mensajes_validaciones_tipos_documentales')[$tipo_documental->carpeta];
        }

        return $data;
    }
}
