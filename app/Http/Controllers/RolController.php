<?php

namespace Archinet\Http\Controllers;

use Archinet\Http\Requests\RequestRegistro;
use Archinet\Http\Requests\RequestRol;
use Archinet\Models\Log;
use Archinet\Models\Registro;
use Archinet\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class RolController extends Controller
{
    public $privilegio_superadministrador = true;
    public $identificador_modulo = 2;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permisoModulo:'.$this->identificador_modulo.',' . $this->privilegio_superadministrador);
    }

    /**s
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'ver', $this->privilegio_superadministrador))
            return redirect('/');
        return view('rol/index')
            ->with('identificador_modulo',$this->identificador_modulo)
            ->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function vistaRoles(Request $request)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'ver', $this->privilegio_superadministrador)){
            if($request->ajax())return response(['error' => ['Unauthorized.']], 401);
            else return redirect('/');
        }
        $filtro = '%'.$request->filtro.'%';

        $roles = Rol::permitidos()
            ->orderBy("nombre")
            ->where('superadministrador','no')
            ->where('nombre','like',$filtro);

        if(!config('params.habilitar_roles_funcionarios')){
            $roles = $roles->where('roles.funcionario','no');
        }
        $roles = $roles->get();
        return view('rol.lista_roles')
            ->with('roles', $roles)
            ->with('identificador_modulo',$this->identificador_modulo)
            ->with('privilegio_superadministrador', $this->privilegio_superadministrador);
    }

    public function vistaPrivilegios(Request $request)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'ver', $this->privilegio_superadministrador)){
            if($request->ajax())return response(['error' => ['Unauthorized.']], 401);
            else return redirect('/');
        }
        $rol = null;
        if ($request->has('rol'))
            $rol = Rol::permitidos()->where('superadministrador','no')->find($request->input('rol'));

        if(!$rol)return response(['error'=>['La información enviada es incorrecta']],422);

        return view('rol.lista_privilegios')
            ->with('rol', $rol)
            ->with('identificador_modulo',$this->identificador_modulo)
            ->with('privilegio_superadministrador', $this->privilegio_superadministrador);
    }

    public function crear(RequestRol $request){
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'crear', $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        $rol = new Rol();
        $rol->nombre = $request->nombre;
        $rol->user_id = Auth::user()->id;

        if(config('params.habilitar_roles_funcionarios')) {
            if ($request->has('funcionario')) {
                $rol_funcionario = Rol::funcionario();
                if (!$rol_funcionario) {
                    $rol->funcionario = 'si';
                } else {
                    return response(['msj_global' => ['Ya existe un rol asignado a funcionarios']], 422);
                }
            }
        }

        $privilegios = '';
        if($request->has('privilegios')){
            if(is_array($request->input('privilegios'))){
                for ($i = 0;$i < count($request->input('privilegios')); $i++){
                    //se separa cada dato por la coma que debe traer para identificar el módulo y la funcion ej: 2,1
                    $data = explode(',',$request->input('privilegios')[$i]);

                    if(count($data) == 2){
                        if(Auth::user()->tieneFuncion($data[0],array_flip(config('params')['funciones'])[$data[1]],$this->privilegio_superadministrador)){
                            $privilegios .= '('.$request->input('privilegios')[$i].')_';
                        }
                    }else{
                        return response(['error' => ['La información enviada es incorrecta']], 422);
                    }
                }
                //se quita el ultimo '_' para que la cadena quede tipo -> (1,2)_(1,3) y no -> (1,2)_(1,3)_
                $privilegios = trim($privilegios,'_');
            }else{
                return response(['error' => ['La información enviada es incorrecta']], 422);
            }
        }
        if($privilegios != '')
            $rol->privilegios = $privilegios;
        else
            return response(['msj_global' => ['Seleccione por lo menos un permiso']], 422);

        $rol_privilegios = Rol::where('privilegios',$privilegios)->first();

        if($rol_privilegios)return response(['msj_global'=>['Ya existe un rol con los permisos seleccionados']],422);

        $rol->save();
        Log::createRol($rol);
        return ['success'=>true];
    }

    public function form(Request $request){
        $rol = new Rol();
        if($request->has('rol')){
            $rol = Rol::permitidos()->find($request->input('rol'));

            if(!$rol)return response(['error'=>['La información enviada es incorrecta']],422);
        }


        return view('rol/form')
            ->with('identificador_modulo',$this->identificador_modulo)
            ->with('rol',$rol)->render();
    }

    public function editar(RequestRol $request){
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'editar', $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        if(!$request->has('rol'))return response(['error'=>['La información envida es incorrecta']],422);

        $rol = Rol::permitidos()->find($request->input('rol'));

        if(!$rol)return response(['error'=>['La información enviada es incorrecta']],422);
        $rol_copy = clone $rol;
        $rol->nombre = $request->nombre;

        if(config('params.habilitar_roles_funcionarios')) {
            $rol->funcionario = 'no';
            if ($request->has('funcionario')) {
                $rol_funcionario = Rol::funcionario();
                if (!$rol_funcionario || ($rol_funcionario->exists && ($rol_funcionario->id == $rol->id))) {
                    $rol->funcionario = 'si';
                } else {
                    return response(['msj_global' => ['Ya existe un rol asignado a funcionarios']], 422);
                }
            }
        }

        $rol->privilegios = '';
        $privilegios = '';
        if($request->has('privilegios')){
            if(is_array($request->input('privilegios'))){
                for ($i = 0;$i < count($request->input('privilegios')); $i++){
                    //se separa cada dato por la coma que debe traer para identificar el módulo y la funcion ej: 2,1
                    $data = explode(',',$request->input('privilegios')[$i]);

                    if(count($data) == 2){
                        if(Auth::user()->tieneFuncion($data[0],array_flip(config('params')['funciones'])[$data[1]],$this->privilegio_superadministrador)){
                            $privilegios .= '('.$request->input('privilegios')[$i].')_';
                        }
                    }else{
                        return response(['error' => ['La información enviada es incorrecta']], 422);
                    }
                }
                //se quita el ultimo '_' para que la cadena quede tipo -> (1,2)_(1,3) y no -> (1,2)_(1,3)_
                $privilegios = trim($privilegios,'_');
            }else{
                return response(['msj_global' => ['La información enviada es incorrecta']], 422);
            }
        }
        if($privilegios != '')
            $rol->privilegios = $privilegios;
        else
            return response(['msj_global' => ['Seleccione por lo menos un permiso']], 422);

        $rol_privilegios = Rol::where('privilegios',$privilegios)
            ->where('roles.id','<>',$rol->id)
            ->first();

        if($rol_privilegios)return response(['msj_global'=>['Ya existe un rol con los permisos seleccionados']],422);

        $rol->save();

        Log::updateRol($rol_copy,$rol);
        return ['success'=>true];
    }

    public function eliminar(Request $request){
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'eliminar', $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        if(!$request->has('rol'))return response(['error'=>['La información enviada es incorrecta']],422);

        $rol = Rol::permitidos()->find($request->input('rol'));

        if(!$rol)return response(['msj_global'=>['La información enviada es incorrecta']],422);

        if(count($rol->usuarios))return response(['msj_global'=>['No se puede eliminar debido a que este rol ya está asignado a un usuario']],422);
        $rol_copy = clone $rol;
        $rol->delete();
        Log::deleteRol($rol_copy);
        return ['success'=>true];
    }
}
