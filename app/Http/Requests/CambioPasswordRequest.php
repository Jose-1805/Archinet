<?php

namespace Archinet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CambioPasswordRequest extends FormRequest
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
            'password'=>'required|min:8|max:30',
            'password_confirm'=>'required|min:8|max:30|same:password',
            'password_old'=>'required|min:8|max:30',
        ];
    }

    public function messages(){
        return[
            'password.required'=>'Debe escribir su nueva contraseña',
            'password.min'=>'El campo contraseña nueva debe contener al menos 8 caracteres',
            'password.max'=>'El campo contraseña nueva no permie más de 30 caracteres',
            'password_confirm.same'=>'Las contraseñas no coinciden, vuelva a intentarlo',

            'password_confirm.required'=>'Debe volver a escribir su nueva contraseña',
            'password_confirm.min'=>'El campo confirme su contraseña debe contener al menos 8 caracteres',
            'password_confirm.max'=>'El campo confirme su contraseña no permie más de 30 caracteres',

            'password_old.required'=>'Debe escribir su contraseña antigua',
            'password_old.min'=>'El campo contraseña antigua debe contener al menos 8 caracteres',
            'password_old.max'=>'El campo contraseña antigua no permie más de 30 caracteres',
        ];
    }
}
