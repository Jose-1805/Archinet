<?php

namespace Archinet\Http\Controllers;

use Archinet\Http\Requests\RequestNuevaCuenta;
use Archinet\Http\Requests\RequestNuevaCuentaVeterinaria;
use Archinet\Http\Requests\RequestRegistro;
use Archinet\Models\Archivo;
use Archinet\Models\Registro;
use Archinet\Models\Ubicacion;
use Archinet\Models\Veterinaria;
use Archinet\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['registro','createPassword','storePassword']]);
    }

    /**
     * Busca el primer módulo activo del usuario y lo redirige
     * Si no encuentra ningún modulo redirecciona a la página de bienvenida de usuario
     *
     * si es un superadministrador abri un modulo
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$privilegios = collect(session('rol')->dataPrivilegios())->where('estado', 'Activo')->sortBy('orden_menu')->groupBy('agrupacion');
        $url = false;
        $privilegios->each(function ($item, $key) use ($privilegios, &$url) {
            foreach ($item as $i) {
                if (Auth::user()->tieneFuncion($i['identificador'], 'ver', false)) {
                    $url = $i['url'];
                    return false;
                }
            }
        });*/

        /*if ($url) {
            return redirect($url);
        } else {*/
            return redirect('/bienvenida-usuario');
        //}
    }

    public function createPassword($token,$id){
        $id = Crypt::decrypt($id);
        $user = User::where('token',$token)->find($id);

        if($user && $user->estado == 'activo') {
            if($user->dependenciasActivas())
                return view('usuario/create_password')->with('user', $user);
        }
        return redirect('/');
    }

    public function storePassword(Request $request){

        $user = User::find($request->input('id'));

        if($user && $user->estado == 'activo') {
            if($user->dependenciasActivas()) {

                //validacion de password
                if($request->has('password') && $request->input('password') != ''){
                    if($request->has('password_confirm')){
                        if(strlen($request->input('password'))<8)
                            return response(['error'=>['La contraseña debe tener 8 caracteres como mínimo.']],422);

                        if($request->input('password') != $request->input('password_confirm'))
                            return response(['error'=>['La contraseña y la verificación no coinciden..']],422);
                    }else{
                        return response(['error'=>['Debe ingresar la confirmación de la contraseña.']],422);
                    }

                    $user->token = null;
                    $user->password = Hash::make($request->input('password'));
                    $user->save();

                    Auth::login($user);

                    return ['success'=>true];
                }else{
                    return response(['error'=>['Todos los campos son obligatorios.']],422);
                }
            }
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }

    public function bienvenidaUsuario(){
        return view('bienvenido_auth');
    }
}
