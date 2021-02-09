<?php

namespace Archinet\Http\Controllers;

use Archinet\Http\Requests\CambioPasswordRequest;
use Archinet\Http\Requests\ConfiguracionCorreosRequest;
use Archinet\Models\Configuracion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Zend\Diactoros\Request;

class ConfiguracionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {
        return view('configuracion/index');
    }

    public function cambiarPassword(CambioPasswordRequest $request){
        $user = Auth::user();
        if(Hash::check($request->input('password_old'),$user->password)){
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return ['success'=>true];
        }else{
            return response(['password_old'=>['La contraseña es incorrecta']],422);
        }
    }

    public function correos(ConfiguracionCorreosRequest $request){
        $last_config = Configuracion::orderBy('id','DESC')->first();
        $registrar = true;

        if($last_config){
            //no existen cambios en relacion a la base de datos
            if($last_config->correo_solicitud_certificados == $request->correo_solicitud_certificados)
                $registrar = false;
        }

        if($registrar) {
            $configuracion = new Configuracion();
            $configuracion->correo_solicitud_certificados = $request->correo_solicitud_certificados;
            $configuracion->user_id = Auth::user()->id;
            $configuracion->save();
        }

        return ['success'=>true];
    }
}
