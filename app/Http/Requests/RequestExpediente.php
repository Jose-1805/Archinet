<?php

namespace Archinet\Http\Requests;

use Archinet\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RequestExpediente extends FormRequest
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
            'apellidos'=>'required|max:45|min:3',
            'email'=>'required|email|max:150|unique:users,email',
            'celular'=>'required|max:10|min:10',
            'direccion'=>'required',
            'estado'=>'required|in:activo,inactivo',
            'estado_civil'=>'required|in:soltero,casado,viudo,separado',
            'telefono_opcional'=>'nullable|min:7|max:7',
            'email_opcional'=>'nullable|email|max:150|unique:users,email',
            'fecha_nacimiento'=>'required|date|before_or_equal:'.date('Y-m-d', strtotime('-18 years')),

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
             'tipo_identificacion.required'=>'Debe escribir un tipo de identificación',
             'tipo_identificacion.in'=>'El campo tipo de identificación debe ser igual a uno de estos valores: cédula de ciudadanía, cédula de extranjería',

                'identificacion.required'=>'Debe escribir un número de identificación',
                'identificacion.max'=>'El campo identificación,no permite más de 10 
                caracteres',
                'identificacion.min'=>'El campo identificación Debe contener al menos 7 caracteres',
                'identificacion.unique'=>'El numero de identificación ya existe',
                'identificacion.digits'=>'El campo, sólo se permiten caracteres numéricos (0-9)',

                'nombres.required'=>'Debe escribir un nombre',
                'nombres.max'=>'El campo nombre no permite más de 45 caracteres',
                'nombres.min'=>'EL campo nombre Debe contener al menos 3 caracteres',
                'nombres.alpha'=>'solo se permiten datos alfabeticos',

                'apellidos.required'=>'Debe escribir un apellido',
                'apellidos.max'=>'El campo apellido, no permite más de 45 caracteres',
                'apellidos.min'=>'EL campo apellido, debe contener al menos 3 caracteres',
                'apellidos.alpha'=>'En el campo nombre sólo se permiten caracteres alfabéticos (a-z/ A-Z)',

                'email.required'=>'Debe escribir un correo SENA',
                'email.email'=>'El campo correo SENA, no contiene el formato correcto',
                'email.max'=>'El campo correo puede contener màximo 150 caracteres',
                'email.unique'=>'El correo SENA, ya se encuentra registrado',

                'email_opcional.email'=>'El campo correo opcional, no contiene el formato correcto',
                'email_opcional.max'=>'El campo correo puede contener màximo 150 caracteres',
                'email_opcional.unique'=>'El correo opcional, ya se encuentra registrado',

                
                'celular.required'=>'Debe escribir un número telefónico',
                'celular.min'=>'El campo teléfono no permite más de 10 caracteres',
                'celular.digits'=>'El campo teléfono, sólo permite caracteres numéricos (0-9)',


                
                'telefono_opcional'=>'El campo teléfono no permite más de 7 caracteres',
                'telefono_opcional.digits'=>'El campo teléfono, sólo permite caracteres numéricos (0-9)',

                'fecha_nacimiento.required'=>'Debe escribir una fecha nacimiento',
                'fecha_nacimiento.date'=>'Fecha de nacimiento, con formato incorrecto',
                'fecha_nacimiento'=>'No es posible seleccionar una fecha mayor a la actual"',

                'estado_civil.required'=>'El campo estado civil, es obligatorio.',
                'estado_civil.in'=>'El campo estado civil Debe ser igual a uno de estos valores: soltero, casado, viudo, separado',

                'direccion.required'=>'Debe escribir una Dirección',
              

                'estado.required'=>'Este campo es obligatorio',
        ];
    }
}
