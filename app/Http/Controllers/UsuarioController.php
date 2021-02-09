<?php

namespace Archinet\Http\Controllers;

use Archinet\Models\Ciudad;
use Archinet\Models\Correo;
use Archinet\Models\Archivo;
use Archinet\Models\Log;
use Archinet\Models\Rol;
use Archinet\Models\Ubicacion;
use Archinet\User;
use Archinet\Http\Requests\RequestUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Facades\Datatables;

class UsuarioController extends Controller
{

    public $privilegio_superadministrador = true;
    protected $identificador_modulo = 3;

    function __construct()
    {
        $this->middleware('permisoModulo:' . $this->identificador_modulo . ',' . $this->privilegio_superadministrador, ['except' => ['validarCuenta', 'validarCuentaSend', 'passwordEmpresario', 'passwordEmpresarioSend']]);
    }

    public function index()
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'ver', $this->privilegio_superadministrador))
            return redirect('/');

        return view('usuario/index')
            ->with('privilegio_superadministrador', $this->privilegio_superadministrador)
            ->with('identificador_modulo', $this->identificador_modulo);
    }

    public function crear()
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'crear', $this->privilegio_superadministrador))
            return redirect('/');

        return view('usuario/crear')->with('privilegio_superadministrador', $this->privilegio_superadministrador);
    }

    public function guardar(RequestUsuario $request)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'crear', $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        DB::beginTransaction();

        $rol = Rol::permitidos()->where('roles.funcionario', 'no')->where('roles.superadministrador', 'no')->find($request->input('rol'));

        if (!$rol)
            return response(['error' => ['La información enviada es incorrecta']], 422);

        $usuario = new User();
        $usuario->fill($request->all());
        $usuario->token = csrf_token();
        $usuario->save();
        $usuario->roles()->save($rol);

        Log::createUser($usuario);

        Correo::nuevaCuentaUsuario($usuario);
        DB::commit();
        return ['success' => true];
    }

    public function editar($id)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'editar', $this->privilegio_superadministrador))
            return redirect('/');

        $usuario = User::permitidos()->select('users.*')
            ->find($id);
        if (!$usuario /*|| $usuario->estado == 'inactivo'*/) return redirect('/');

        return view('usuario/editar')
            ->with('usuario', $usuario)
            ->with('privilegio_superadministrador', $this->privilegio_superadministrador);
    }

    public function actualizar(RequestUsuario $request)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'editar', $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized']], 401);

        DB::beginTransaction();
        $user = User::permitidos()->find($request->input('usuario'));
        if (!$user /*|| $user->estado == 'inactivo'*/)
            return response(['error' => ['La información enviada es incorrecta']], 422);

        $user_copy = clone $user;
        $user->fill($request->all());
        $user->save();

        $rol = Rol::permitidos()->where('roles.funcionario', 'no')->where('roles.superadministrador', 'no')->find($request->input('rol'));

        if (!$rol)
            return response(['error' => ['La información enviada es incorrecta']], 422);

        $user->roles()->detach();

        $user->roles()->save($rol);
        Log::updateUser($user_copy,$user);
        DB::commit();
        return ['success' => true];
    }

    public function lista()
    {
        $usuarios = User::permitidos()->select('users.id',
            DB::raw('CONCAT(users.nombres," ",users.apellidos) as nombre'),
            'users.celular',
            'users.email',
            'users.fecha_inicio_contrato',
            'users.fecha_terminacion_contrato',
            'users.estado')
            ->join('roles_users', 'users.id','=','roles_users.user_id')
            ->join('roles', 'roles.id','=','roles_users.rol_id')
            ->where('users.id', '<>', Auth::user()->id)
            ->where('roles.funcionario', '<>', 'si')
//            ->where('roles.funcionario', '<>', 'si', Auth::user()->id)
            ->get();


        $table = Datatables::of($usuarios);//->removeColumn('id');

        $table = $table->editColumn('opciones', function ($r) {
            $opc = '';
            if (Auth::user()->tieneFuncion($this->identificador_modulo, 'editar', $this->privilegio_superadministrador)) {
                //if ($r->estado == 'activo') {
                $opc .= '<a href="' . url('/usuario/editar') . '/' . $r->id . '" class="btn btn-xs btn-primary margin-2" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="white-text fa fa-edit"></i></a>';
//                        $opc .= '<a href="#!" class="btn btn-xs btn-danger margin-2 btn-desactivar-usuario" data-usuario="' . $r->id . '"  data-toggle="tooltip" data-placement="bottom" title="Inactivar"><i class="white-text fa fa-chevron-down"></i></a>';
                //}
//                    if ($r->estado == 'inactivo')
//                        $opc .= '<a href="#!" class="btn btn-xs btn-primary margin-2 btn-activar-usuario" data-usuario="' . $r->id . '" data-toggle="tooltip" data-placement="bottom" title="Activar"><i class="white-text fa fa-chevron-up"></i></a>';
            }
            return $opc;


        })->editColumn('rol', function ($r) {
            $roles = $r->roles;
            $roles_txt = "";
            foreach ($roles as $rol) {
                $roles_txt .= $rol->nombre . '/';
            }
            return trim($roles_txt, '/');
        })->rawColumns(['opciones']);

        if (!Auth::user()->tieneFunciones($this->identificador_modulo, ['editar'], false, $this->privilegio_superadministrador)) $table->removeColumn('opciones');

        $table = $table->make(true);
        return $table;
    }

    public function activar(Request $request)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'editar', $this->privilegio_superadministrador))
            return response(['error' => ['La información enviada es incorrecta.']], 422);

        $usuario = '';
        $usuario->estado = 'activo';
        $usuario->save();
        $usuario = User::permitidos()->find($request->input('usuario'));
        if ($usuario) {
            return ['success' => true];
        }

        return response(['error' => ['La información enviada es incorrecta.']], 422);
    }

    public function desactivar(Request $request)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'editar', $this->privilegio_superadministrador))
            return response(['error' => ['La información enviada es incorrecta.']], 422);

        $usuario = User::permitidos()->find($request->input('usuario'));

        if ($usuario) {
            $usuario->estado = 'inactivo';
            $usuario->save();
            return ['success' => true];
        }

        return response(['error' => ['La información enviada es incorrecta.']], 422);
    }
}
