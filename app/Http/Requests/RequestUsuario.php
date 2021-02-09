<?php

namespace Archinet\Http\Requests;

use Archinet\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RequestUsuario extends FormRequest
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
            //datos personales
            'tipo_identificacion'=>'required|in:cédula de ciudadanía,cédula de extranjería',
            'identificacion'=>'required|max:10|min:7|unique:users,identificacion',
            'nombres'=>'required|max:45|min:3|regex:/[A-Za-z ñ]/',
            'apellidos'=>'required|max:45|min:3|regex:/[A-Za-z ñ]/',
            'email'=>'required|email|max:150|unique:users,email',
            'celular'=>'required|max:10|min:10',
            'fecha_inicio_contrato'=>'required|date|before:fecha_terminacion_contrato',
            'fecha_terminacion_contrato'=>'required|date|after:fecha_inicio_contrato',

            'rol'=>'required|exists:roles,id',
            'estado'=>'required|in:activo,inactivo',
        ];

        //es una edición
        if($this->has('usuario')){
            $data['identificacion'] = 'required|max:15|unique:users,identificacion,'.$this->input('usuario').',id';
            $data['email'] = 'required|email|max:150|unique:users,email,'.$this->input('usuario').',id';
        }

        return $data;
    }

    public function messages(){
        return[
            //datos personales
            'tipo_identificacion.required'=>'Este campo es obligatorio.',
            'tipo_identificacion.in'=>'El campo tipo de identificación debe ser igual a uno de estos valores: cédula de ciudadanía, cédula de extranjería.',

            'identificacion.required'=>'Debe escribir un número de identificación',
            'identificacion.max'=>'Este campo no permite más de 10 caracteres',
            'identificacion.min'=>'El campo identificación debe contener al menos 7 caracteres.',
            'identificacion.unique'=>'El numero de identificación ya existe',
            'identificacion.digits'=>'Sólo se permiten caracteres numéricos (0-9)',

            'nombres.required'=>'Debe escribir un nombre',
            'nombres.max'=>'Este campo no permite más de 45 caracteres',
            'nombres.min'=>'EL campo nombre debe contener al menos 3 caracteres',

            'apellidos.required'=>'Debe escribir un apellido',
            'apellidos.max'=>'Este campo no permite más de 45 caracteres',
            'apellidos.min'=>'EL campo nombre debe contener al menos 3 caracteres',

            'email.required'=>'Debe escribir un correo',
            'email.email'=>'El campo correo no contiene el formato correcto',
            'email.max'=>'El campo correo puede contener màximo 150 caracteres',
            'email.unique'=>'EL usuario ya se encuentra registrado',

            'celular.required'=>'Debe escribir un número telefonico',
            'celular.max'=>'Este campo no permite más de 10 caracteres',
            'celular.min'=>'Este campo no permite menos de 10 caracteres',
            'celular.digits'=>'Sólo se permiten caracteres numéricos (0-9)',

            'fecha_inicio_contrato.required'=>'Debe escribir una fecha',
            'fecha_inicio_contrato.date'=>'Formato incorrecto',
            'fecha_inicio_contrato.before'=>'No es posible seleccionar una fecha mayor a la establecida en el campo "fecha fin de contrato"',

            'fecha_terminacion_contrato.required'=>'Debe escribir una fecha',
            'fecha_terminacion_contrato.date'=>'Formato incorrecto',
            'fecha_terminacion_contrato.after'=>'No es posible seleccionar una fecha menor a la establecida en el campo "fecha inicio de contrato"',

            'rol.required'=>'Debe seleccionar un rol',
            'rol.exists'=>'La información enviada es incorrecta',

            'estado.required'=>'Este campo es obligatorio',
        ];
    }
}