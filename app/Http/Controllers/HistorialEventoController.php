<?php

namespace Archinet\Http\Controllers;

use Illuminate\Http\Request;
use Archinet\Models\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Archinet\User;
use Archinet\Http\Requests\RequestUsuario;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class HistorialEventoController extends Controller
{

    public $privilegio_superadministrador = true;
    protected $identificador_modulo = 5;

    public function index()
    {

        return view('historial_eventos/index');


    }

    public function listaEventos(Request $request)
    {
        $eventos =
            Log::select('logs.id', 'users.identificacion', DB::raw('CONCAT(users.nombres," ",users.apellidos) as nombreUsuario'), 'logs.created_at',  DB::raw('CONCAT(logs.modulo," ","(",logs.registro_afectado,")") 
             as modulo'),'logs.tipo', 'roles.nombre', 'logs.registro_nuevo', 'logs.registro_anterior')
                ->join('roles', 'roles.id', '=', 'logs.rol_id')->join('users', 'users.id', '=', 'logs.user_id');
        if ($request->get('modulos') && $request->get('modulos') !== "") {
            $eventos = $eventos->where('logs.modulo', '=', $request->get('modulos'));
        }
        if ($request->get('actividades')  && $request->get('actividades') !== "") {
            $eventos = $eventos->where('logs.tipo', '=', $request->get('actividades'));

        }

        $eventos = $eventos->get();
//        foreach ($eventos as $evento){
//            $evento->diferencias = json_encode($evento->printDiferencias($nuevo = true,$separador = ':'));
//
//        }



        $table = Datatables::of($eventos);
        $table = $table->editColumn('opciones', function ($r) {
            $opc = '';
            if (Auth::user()->tieneFuncion($this->identificador_modulo, 'ver', $this->privilegio_superadministrador)) {
                $opc .= $r->printDiferenciasJSON();
                //echo "//";

            }
            return $opc;


        });
        $table = $table->make(true);


        return $table;


    }

    public function exportar($modulo = null,$actividad = null){
        $log = Log::select('*');

        if($modulo && $modulo != 'undefined'){
            $log = $log->where('modulo',$modulo);
        }

        if($actividad != 'undefined'){
            $log = $log->where('tipo',$actividad);
        }

        $log = $log->get();

        //dd($log);
        Excel::create('historial_eventos',function ($excel) use ($log){
            $excel->sheet('LOG', function($sheet) use ($log) {
                $sheet->loadView('historial_eventos.lista_exportar',['log'=>$log]);

                $sheet->cells('A:F', function($cells) {
                    $cells->setValignment('top');
                });

                $sheet->setAutoSize(['E','F']);
            });
        })->download('xls');
    }
}
