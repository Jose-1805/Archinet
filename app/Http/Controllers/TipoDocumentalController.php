<?php

namespace Archinet\Http\Controllers;

use Archinet\Http\Requests\RequestGestionTipoDocumental;
use Archinet\Http\Requests\RequestRegistro;
use Archinet\Http\Requests\RequestRol;
use Archinet\Models\Log;
use Archinet\Models\Registro;
use Archinet\Models\Rol;
use Archinet\Models\TipoDocumental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class TipoDocumentalController extends Controller
{
    public $privilegio_superadministrador = true;
    public $identificador_modulo = 5;

    public static $PRIVILEGIO_SUPERADMINISTRADOR = true;
    public static $IDENTIFICADOR_MODULO = 5;

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
        return view('tipo_documental/index')
            ->with('identificador_modulo',$this->identificador_modulo)
            ->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function lista(){
        $tipos_documentales = TipoDocumental::select('tipos_documentales.*','secciones.nombre as seccion')
            ->join('secciones','tipos_documentales.seccion_id','=','secciones.id')
            ->get();


        $tabla = Datatables::of($tipos_documentales);

        $tabla = $tabla->editColumn('editar', function ($r) {
            $opc = '';
            if (Auth::user()->tieneFuncion($this->identificador_modulo, 'editar', $this->privilegio_superadministrador)) {
                $opc .= '<a href="#!" class="btn btn-xs btn-primary margin-2 btn-editar-tipo-documental" data-tipo-documental="'.$r->id.'" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="white-text fa fa-edit"></i></a>';
            }

            return $opc;


        })->rawColumns(['editar']);

        return $tabla->make(true);
    }

    public function guardar(RequestGestionTipoDocumental $request){
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'crear', $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        $tipo_documental = new TipoDocumental();
        $tipo_documental->nombre = $request->nombre;
        $tipo_documental->descripcion = $request->nombre;
        $tipo_documental->seccion_id = $request->seccion;
        $tipo_documental->carpeta = strtolower(str_replace(' ','_', $request->nombre));
        $tipo_documental->user_id = Auth::user()->id;
        $tipo_documental->save();

        Log::createGestionTipoDocumental($tipo_documental);
        return ['success'=>true];
    }

    public function form(Request $request){
        $tipo_documental = new TipoDocumental();
        if($request->has('id')){
            $tipo_documental = TipoDocumental::select('tipos_documentales.*','seccion_id as seccion')->find($request->input('id'));

            if(!$tipo_documental)return response(['error'=>['La información enviada es incorrecta']],422);
        }


        return view('tipo_documental/form')
            ->with('identificador_modulo',$this->identificador_modulo)
            ->with('id_form','form-editar-tipo-documental')
            ->with('tipo_documental',$tipo_documental)->render();
    }

    public function editar(RequestGestionTipoDocumental $request){
        if (!Auth::user()->tieneFuncion($this->identificador_modulo, 'editar', $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        if(!$request->has('id'))return response(['error'=>['La información envida es incorrecta']],422);

        $tipo_documental = TipoDocumental::find($request->input('id'));

        if(!$tipo_documental)
            return response(['error'=>['La información envida es incorrecta']],422);

        $tipo_documental_old = clone $tipo_documental;

        $tipo_documental->nombre = $request->nombre;
        $tipo_documental->descripcion = $request->nombre;
        $tipo_documental->seccion_id = $request->seccion;
        $tipo_documental->carpeta = strtolower(str_replace(' ','_', $request->nombre));
        $tipo_documental->save();


        Log::updateGestionTipoDocumental($tipo_documental,$tipo_documental_old);
        return ['success'=>true];
    }

}
