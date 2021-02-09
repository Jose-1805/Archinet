<?php

namespace Archinet\Http\Controllers;

use Archinet\Http\Requests\RequestTipoDocumental;
use Archinet\Models\Archivo;
use Archinet\Models\Correo;
use Archinet\Models\Documento;
use Archinet\Models\Log;
use Archinet\Models\Metadato;
use Archinet\Models\Pdf;
use Archinet\Models\Rol;
use Archinet\Models\Seccion;
use Archinet\Models\TipoDocumental;
use Archinet\User;
use Archinet\Http\Requests\RequestExpediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Facades\Datatables;

class ExpedienteController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $identificador_modulo = 4;

    public static $PRIVILEGIO_SUPERADMINISTRADOR = true;
    public static $IDENTIFICADOR_MODULO = 4;

    function __construct()
    {
        $this->middleware('permisoModulo:' . $this->identificador_modulo . ',' . $this->privilegio_superadministrador, ['except' => ['validarCuenta', 'validarCuentaSend', 'passwordEmpresario', 'passwordEmpresarioSend',
         'index','seccion','listatiposdocumentales']]);
    }

    public function index($id = null)
    {
        if ($id || Auth::user()->esFuncionario()) {
            $tiposDocumentales = TipoDocumental::orderBy('nombre','ASC')->get();

            if(Auth::user()->esFuncionario())
                $user = Auth::user();
            else
                $user = User::find($id);

            if ($user && $user->esFuncionario()) {
                return view('expediente/documentos/index')
                    ->with('privilegio_superadministrador', $this->privilegio_superadministrador)
                    ->with('identificador_modulo', $this->identificador_modulo)
                    ->with('user', $user)
                    ->with('tiposDocumentales', $tiposDocumentales);

            }
        } else {
            if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'ver', $this->privilegio_superadministrador))
                return redirect('/');

            return view('expediente/index')
                ->with('privilegio_superadministrador', $this->privilegio_superadministrador)
                ->with('identificador_modulo', $this->identificador_modulo);
        }

        return redirect('/');
    }

    public function crear(Request $request)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'crear', $this->privilegio_superadministrador))
            return redirect('/');

        return view('expediente/crear')->with('privilegio_superadministrador', $this->privilegio_superadministrador);
    }

    public function guardar(RequestExpediente $request)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'crear', $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        DB::beginTransaction();

        $rol = Rol::where('roles.funcionario', 'si')->get()->first();
        //print_r($rol);

//
        if (!$rol)
            return response(['error' => ['La información enviada es incorrecta']], 422);

        $usuario = new User();
        $usuario->fill($request->all());
        $usuario->token = csrf_token();
        $usuario->save();

        $usuario->roles()->save($rol);
        Log::createExpeiente($usuario);
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

        return view('expediente/editar')
            ->with('usuario', $usuario)
            ->with('privilegio_superadministrador', $this->privilegio_superadministrador);
    }

    public function actualizar(RequestExpediente $request)
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
        //$user->roles()->detach();
        Log::updateExpeiente($user_copy,$user);
        DB::commit();
        return ['success' => true];
    }

    public function lista(Request $request)
    {
        $funcionarios = User::permitidos()->select(
            'users.id',
            'users.identificacion',
            DB::raw('CONCAT(users.apellidos," ",users.nombres) as nombre'),
            'users.celular',
            'users.telefono_opcional',
            'users.fecha_nacimiento',
            'users.email',
            'users.email_opcional',
            'users.direccion',
            'users.estado')
            ->join('roles_users', 'users.id', '=', 'roles_users.user_id')
            ->join('roles', 'roles.id', '=', 'roles_users.rol_id')
            ->where('users.id', '<>', Auth::user()->id)
            ->where('roles.funcionario', '<>', 'no')
            ->get();

        $table = Datatables::of($funcionarios);//->removeColumn('id');

        $table = $table->editColumn('opciones', function ($r) {
            $opc = '';
            if (Auth::user()->tieneFuncion($this->identificador_modulo, 'editar', $this->privilegio_superadministrador)) {
                //if ($r->estado == 'activo') {
                $opc .= '<a href="' . url('/expediente/editar') . '/' . $r->id . '" class="btn btn-xs btn-primary margin-2" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="white-text fa fa-edit"></i></a>';
                $opc .= '<a href="' . url('/expediente/') . '/' . $r->id . '" class="btn btn-xs btn-primary margin-2" data-toggle="tooltip" data-placement="bottom" title="Ver expediente" style=" margin-left:.2rem;" ><i
                 class="white-text fas fa-folder-open"></i></a>';
            }

            $opc .= '<a href="' . url('/expediente/hoja-vida') . '/' . $r->id . '" target="_blank" class="btn btn-xs btn-primary margin-2" data-toggle="tooltip" data-placement="bottom" title="Hoja de vida"><i class="white-text fa fa-file"></i></a>';
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

    public function listatiposdocumentales(Request $request)
    {
        $documentos = Documento::select('documentos.*',
            DB::raw('CONCAT(tipos_documentales.nombre ) as tipo_documental')
        )
            ->join('tipos_documentales', 'documentos.tipo_documental_id', '=', 'tipos_documentales.id')
            ->join('secciones', 'tipos_documentales.seccion_id', '=', 'secciones.id')
            ->where('documentos.user_id',$request->get('userId'));

        if ($request->get('seccionId')) {
            $documentos = $documentos->where('secciones.id','=' , $request->get('seccionId'));
        }

        $documentos = $documentos->get();

        $table = Datatables::of($documentos);

        $table = $table->editColumn('fecha_documento', function ($r) {
                if($r->fecha_documento)return $r->fecha_documento;
                return 'Sin fecha';
            })
            ->editColumn('tipo_documental', function ($r) {
            $tipo_documental = $r->tipo_documental;

            if($r->descripcion){
                $tipo_documental .= '<br>('.$r->descripcion.')';
            }

            $tipo_documental = '<a style="color: #007bff;" class="btn-ver-documento" data-documento="'.$r->id.'" href="#!">'.$tipo_documental.'</a>';

            return $tipo_documental;
        })->editColumn('numero_folio',function ($r){
            if($r->cantidad_folios > 1)return $r->numero_folio.' - '.(($r->numero_folio + $r->cantidad_folios)-1);

            return $r->numero_folio;
        })->rawColumns(['tipo_documental']);

        $table = $table->make(true);
        return $table;
    }

    public function seccion(Request $request, $seccion, $id)
    {
//        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'ver', $this->privilegio_superadministrador))
//            return redirect('/');
        $user = User::find($id);
        if ($user && $user->esFuncionario()) {
            $seccion = Seccion::where('nombre_carpeta', $seccion)->first();

            if ($seccion) {
                return view('expediente/documentos/seccion')
                    ->with('privilegio_superadministrador', $this->privilegio_superadministrador)
                    ->with('identificador_modulo', $this->identificador_modulo)
                    ->with('seccion', $seccion)
                    ->with('user', $user);
            }
        } else {
            if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'ver', $this->privilegio_superadministrador))

                return view('expediente/documentos/seccion')
                    ->with('privilegio_superadministrador', $this->privilegio_superadministrador)
                    ->with('identificador_modulo', $this->identificador_modulo)
                    ->with('seccion', $seccion)
                    ->with('user', $user);
        }
        return redirect('/');
    }

    public function formTipoDocumental(Request $request)
    {
        if ($request->has('seleccion_tipo_documental')) {
            $tipo_documental = TipoDocumental::find($request->seleccion_tipo_documental);
            return view('expediente/documentos/secciones/datos_form_tipo_documental')
                ->with('tipo_documental', $tipo_documental)
                ->with('privilegio_superadministrador', $this->privilegio_superadministrador)
                ->with('identificador_modulo', $this->identificador_modulo);
        }
    }

    public function guardarTipoDocumental(RequestTipoDocumental $request)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'crear', $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        $tipo_documental = TipoDocumental::find($request->tipo_documental);


        $usuario = User::find($request->usuario);
        if ($tipo_documental && $usuario && $usuario->esFuncionario()) {
            DB::beginTransaction();
            //se guarda toda la información necesaria para el documento
            $documento = new Documento();
            //si tiene permisos para validar documentos y se seleccionó la casilla de verificación
            if (Auth::user()->tieneFuncion($this->identificador_modulo, 'validar_documentos', $this->privilegio_superadministrador)) {
                if ($request->has('validar') && $request->validar == 'si') {
                    $documento->validado = 'si';
                }
            }
            $data_fill_save = $documento->fillAndSave($usuario, $tipo_documental, $request);

            if(!$data_fill_save['success']){
                return response($data_fill_save['errores'], 422);
            }

            //notificacion de archivo no validado
            if ($documento->validado != 'si') {
                Correo::documentoNoValidado($usuario, $documento);
            }

            $archivo = $request->file('archivo');
            $nombre = $archivo->getClientOriginalName();
            $nombre = str_replace('-', '', $nombre);
            $nombre = str_replace('_', '', $nombre);
            $ruta = 'app/restringido/'
                . $usuario->id . '/historia_laboral/' . $tipo_documental->seccion->nombre_carpeta
                . '/' . $tipo_documental->carpeta . '/' . $documento->id;
            $archivo_obj = new Archivo();
            $archivo_obj->ubicacion = $ruta;
            $archivo_obj->nombre = $nombre;
            $archivo_obj->save();

            $ruta = storage_path($ruta);
            $archivo->move($ruta, $nombre);

            $documento->archivo_id = $archivo_obj->id;
            $documento->save();

            Log::createTipoDocumental($documento);

            DB::commit();
            return [
                'success' => true
            ];
        }
        return response(['error' => ['La información enviada es incorrecta']], 422);
    }

    public function validarDocumento($id)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'validar_documentos', $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        $documento = Documento::find($id);
        if ($documento) {
            if ($documento->validado == 'no') {
                $documento->validado = 'si';
                $documento->save();
                Log::validarTipoDocumental($documento);
            }
            return ['success' => true];
        }
        return response(['error' => ['La información enviada es incorrecta']], 422);
    }

    public function datosDocumento(Request $request)
    {
        if($request->has('id')){
            $documento = Documento::permitidos()->find($request->id);
            if($documento){
                return view('expediente.documentos.datos_documento')
                    ->with('documento',$documento);
            }
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }

    public function verDocumento($id){
        $documento = Documento::permitidos()->find($id);

        if($documento){
            $archivo = $documento->archivo;
            $path = $archivo->ubicacion .'-'.$archivo->nombre;

            $path = storage_path() .'/'. str_replace('-','/', $path);

            if(!File::exists($path)) abort(404);

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);

            return $response;
        }

        return redirect('/');
    }

    public function formEditarDocumento(Request $request)
    {
        $documento = Documento::permitidos()
            ->select('documentos.*',
                'salario','numero_acta', 'fecha_nombramiento', 'tipo_nombramiento', 'tipo_novedad', 'cargo', 'cargo_externa', 'grado', 'dependencia', 'tipo', 'fecha_vinculacion', 'fecha_terminacion', 'asignacion_mensual', 'empresa', 'regional', 'fecha_inicio', 'fecha_fin', 'nivel_estudio', 'graduado', 'tipo_duracion', 'duracion', 'institucion', 'titulo_obtenido', 'nombre_curso', 'no_resolucion', 'no_dias_vacacionar', 'no_dias_no_vacacionados', 'no_resolucion_anterior')
            ->leftJoin('metadatos','documentos.id','=','metadatos.documento_id')
            ->find($request->id);

        if ($documento) {
            return view('expediente/documentos/form_editar_documento')
                ->with('documento', $documento)
                ->with('privilegio_superadministrador', $this->privilegio_superadministrador)
                ->with('identificador_modulo', $this->identificador_modulo);
        }
    }

    public function editarDocumento(RequestTipoDocumental $request)
    {
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'editar', $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        $documento = Documento::permitidos()->find($request->documento);
        if($documento) {
            $tipo_documental = $documento->tipoDocumental;
            $metadatos = $documento->metadatos;
            $archivo_objeto = $documento->archivo;

            $documento_previo = clone $documento;

            $metadatos_previos = new Metadato();
            if($metadatos)
                $metadatos_previos = clone $metadatos;

            $archivo_previo = new Archivo();
            if($archivo_objeto)
                $archivo_previo = clone $archivo_objeto;

            if ($tipo_documental) {
                DB::beginTransaction();

                //si tiene permisos para validar documentos y se seleccionó la casilla de verificación
                if (Auth::user()->tieneFuncion($this->identificador_modulo, 'validar_documentos', $this->privilegio_superadministrador)) {
                    $documento->validado = 'no';
                    if ($request->has('validar') && $request->validar == 'si') {
                        $documento->validado = 'si';
                    }
                }

                $data_fill_save = $documento->fillAndUpdate($request);

                if (!$data_fill_save['success']) {
                    return response($data_fill_save['errores'], 422);
                }

                $usuario = $documento->user;
                //notificacion de archivo no validado
                if ($documento->validado != 'si') {
                    Correo::documentoNoValidado($usuario, $documento);
                }

                if($request->hasFile('archivo')) {
                    $archivo = $request->file('archivo');
                    $nombre = $archivo->getClientOriginalName();
                    $nombre = str_replace('-', '', $nombre);
                    $nombre = str_replace('_', '', $nombre);
                    $ruta = 'app/restringido/'
                        . $usuario->id . '/historia_laboral/' . $tipo_documental->seccion->nombre_carpeta
                        . '/' . $tipo_documental->carpeta . '/' . $documento->id;

                    $archivo_old = $documento->archivo;

                    //si existe un registro de archivo anterior se actualiza
                    if($archivo_old){
                        //se borra el archivo del sistema
                        $ruta_old = $archivo_old->ubicacion.'/'.$archivo_old->nombre;
                        @unlink(storage_path($ruta_old));

                        $archivo_obj = $archivo_old;
                    }else{
                        $archivo_obj = new Archivo();

                        $documento->archivo_id = $archivo_obj->id;
                    }

                    $archivo_obj->ubicacion = $ruta;
                    $archivo_obj->nombre = $nombre;
                    $archivo_obj->save();

                    $ruta = storage_path($ruta);

                    $archivo->move($ruta, $nombre);

                    $documento->save();
                }

                $metadatos = $documento->metadatos;
                if(!$metadatos)$metadatos = new Metadato();

                $archivo = $documento->archivo;
                if(!$archivo)$archivo = new Metadato();

                Log::updateTipoDocumental($documento,$metadatos,$documento_previo,$archivo,$metadatos_previos,$archivo_previo);

                DB::commit();
                return [
                    'success' => true
                ];
            }
        }
        return response(['error' => ['La información enviada es incorrecta']], 422);
    }

    public function hojaVida(Request $request,$id){
        $user = User::find($id);

        if($user && $user->esFuncionario()) {
            Pdf::hojaVida($user);
        }

        return redirect('/');
    }
}