<?php

namespace Archinet\Http\Controllers;


use Archinet\Models\Correo;
use Archinet\Models\Log;
use Archinet\User;
use Archinet\Models\Rol;
use Archinet\Http\Requests\RequestExpediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationData;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Facades\Datatables;
use Maatwebsite\Excel\Facades\Excel;


class ImportController extends Controller
{
    public function import(Request $request)
    {
        $v = Validator::make($request->all(),[
            //'excel' => 'required|file|max:1|mimetypes:.xls, .xlsx, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel',
        ],[
            'excel.mimetypes'=>'Solo se permiten archivos excel',
            'excel.max'=>'los archivos deben ser de maximo 1GB'
        ]);

        $errores = '';

        if ($v->errors()->all()) {
            $msg = '';
            foreach($v->errors()->all() as $error){
                if ($msg !== ''){
                    $msg .= ', ';
                }
                $msg .= $error;
            }
            if ($errores !== ''){
                $errores .= '<br><br>';
            }
            $errores .= $msg;
            return redirect('expediente')->with('msg', $errores);
        }

        Excel::load($request->file("excel")->getRealPath(), function ($reader) {
            $i=1;
            $errores='';
            $mensajes=[
                'tipo_identificacion.required'=>'debe escribir un tipo de identificación.',
                'tipo_identificacion.in'=>'El campo tipo de identificación debe ser igual a uno de estos valores: cédula de ciudadanía, cédula de extranjería.',

                'identificacion.required'=>'debe escribir un número de identificación.',
                'identificacion.max'=>'El campo identificación,no permite más de 10 caracteres',
                'identificacion.min'=>'El campo identificación debe contener al menos 7 caracteres.',
                'identificacion.unique'=>'El numero de identificación ya existe',
                'identificacion.digits'=>'El campo, sólo se permiten caracteres numéricos (0-9)',

                'nombres.required'=>'debe escribir un nombre',
                'nombres.max'=>'El campo nombre no permite más de 45 caracteres',
                'nombres.min'=>'EL campo nombre debe contener al menos 3 caracteres',
                'nombres.alpha'=>'solo se permiten datos alfabeticos',

                'apellidos.required'=>'debe escribir un apellido',
                'apellidos.max'=>'El campo apellido no permite más de 45 caracteres',
                'apellidos.min'=>'EL campo apellido debe contener al menos 3 caracteres',

                'email.required'=>'debe escribir un correo SENA',
                'email.email'=>'El campo correo SENA, no contiene el formato correcto',
                'email.max'=>'El campo correo puede contener màximo 150 caracteres',
                'email.unique'=>'El correo, ya se encuentra registrado',

                'celular.required'=>'debe escribir un número de teléfono',
                'celular.min'=>'El campo teléfono no permite más de 10 caracteres',
               
                'celular.digits'=>'El campo celular, sólo permite caracteres numéricos (0-9)',

                'fecha_nacimiento.required'=>'debe escribir una fecha de fecha nacimiento',
                'fecha_nacimiento.date'=>'Fecha de nacimiento, con formato incorrecto',
                'fecha_nacimiento'=>'No es posible seleccionar una fecha mayor a la actual"',

                'direccion.required'=>'debe escribir una dirección',

                'estado_civil.required'=>'El campo estado civil, es obligatorio.',
                'estado_civil.in'=>'El campo estado civil debe ser igual a uno de estos valores: soltero, casado, viudo, separado',

                'estado.required'=>'El campo estado funcionario, es obligatorio',
            ];

            DB::beginTransaction();
            foreach ($reader->get() as $usuarios) {
                $i++;

                if(!isset($usuarios->tipo_identificacion)){
                    $errores ="Archivo no valido";
                    break;
                }

                $user = [
                    'tipo_identificacion' => $usuarios->tipo_identificacion,
                    'identificacion' => $usuarios->identificacion,
                    'nombres' => $usuarios->nombres,
                    'apellidos' => $usuarios->apellidos,
                    'email' => $usuarios->email,
                    'telefono_opcional' => $usuarios->telefono_opcional,
                    'celular' => $usuarios->celular,
                    'fecha_nacimiento' => $usuarios->fecha_nacimiento,
                    'direccion' => $usuarios->direccion,
                    'estado' => $usuarios->estado,
                    'estado_civil'=> $usuarios->estado_civil
                ];

                $arrayVal = [
                    'tipo_identificacion'=>'required|in:cédula de ciudadanía,cédula de extranjería',
                    'identificacion' => 'required|max:10|min:7|unique:users,identificacion',
                    'nombres'=>'required|alpha|max:45|min:3',
                    'apellidos'=>'required|max:45|min:3',
                    'email'=>'required|email|max:150|unique:users,email',
                    'celular'=>'max:10|min:10',
                    'direccion'=>'required',
                    'fecha_nacimiento'=>'required|date',
                    'estado'=>'required|in:activo,inactivo',
                    'estado_civil'=>'required|in:soltero,casado,viudo,separado',
                ];

                if(strlen($usuarios->email_opcional) !== 0){
                    $arrayVal['email_opcional'] = 'email|max:150|unique:users,email';
                }

                if(strlen($usuarios->telefono_fijo) !== 0){
                    $arrayVal['telefono_fijo'] = 'numeric|max:10|min:7';
                }

                $v = Validator::make($user, $arrayVal, $mensajes);

     		    if ($v->errors()->all()) {
     		        $msg = '';
     		        foreach($v->errors()->all() as $error){
     		            if ($msg !== ''){
     		                $msg .= ', ';
                        }
                        $msg .= $error;
                    }
                    if ($errores !== ''){
                        $errores .= '<br><br>';
                    }
     		        $errores .= '<strong>Celda '.$i.':</strong> '.$msg;
     		        continue;
                }

     			$usuario_creado = User::create([
                    'tipo_identificacion' => $usuarios->tipo_identificacion,
                    'identificacion' => $usuarios->identificacion,
                    'nombres' => $usuarios->nombres,
                    'apellidos' => $usuarios->apellidos,
                    'email' => $usuarios->email,
                    'telefono_opcional' => $usuarios->telefono_opcional,
                    'celular' => $usuarios->celular,
                    'fecha_nacimiento' => $usuarios->fecha_nacimiento,
                    'direccion' => $usuarios->direccion,
                    'estado' => $usuarios->estado,
                    'estado_civil' => $usuarios->estado_civil,
                ]);

     		    $usuario_creado->token = csrf_token();
     		    $usuario_creado->save();

     		    $rol = Rol::where('roles.funcionario','si')->get()->first();
     		    $usuario_creado->roles()->save($rol);

                Log::createExpeiente($usuario_creado);
                Correo::nuevaCuentaUsuario($usuario_creado);
      		}

      		if(isset($errores) && $errores){
                DB::rollback();
            }else{
      		    DB::commit();
            }

      		$_SESSION['errores_temp'] = $errores;
        });

        $errores = $_SESSION['errores_temp']===''?'Importación ejecutada con éxito':$_SESSION['errores_temp'];

        unset($_SESSION['errores_temp']);

        return redirect('expediente')->with('msg', $errores);
    }
}
