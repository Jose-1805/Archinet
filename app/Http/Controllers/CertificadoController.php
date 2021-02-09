<?php

namespace Archinet\Http\Controllers;

use Archinet\Http\Requests\RequestCertificadoDetallado;
use Archinet\Models\Configuracion;
use Archinet\Models\Correo;
use Archinet\Models\Documento;
use Archinet\Models\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificadoController extends Controller
{
    public $privilegio_superadministrador = false;
    public $identificador_modulo = 6;

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

        return view('certificado/index')
            ->with('identificador_modulo',$this->identificador_modulo)
            ->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function validarRequisitos(Request $request){

        $documentos = Documento::permitidos()
            ->select('documentos.*','tipos_documentales.nombre as nombre_tipo_documental')
            ->join('tipos_documentales','documentos.tipo_documental_id','=','tipos_documentales.id')
            ->where('validado','no')->get();

        $error = '';

        $exists_error = false;

        $errors = [];

        //existen documentos sin validar
        if(count($documentos)){
            $error .= 'Señor funcionario recuerde que usted tiene pendiente por validar los siguientes documentos: <ul>';

            foreach ($documentos as $documento){
                $error .= '<li>'.$documento->nombre_tipo_documental.'</li>';
            }

            $error .= '</ul>por favor acercarse a la oficina de relaciones laborales  del SENA centro Comercio y Servicios con el documento original.';

            $exists_error = true;
            $errors[] = $error;
        }

        //se consulta si existen certificaos laborales internos
        $actas = Documento::actasPosesionNombramiento(Auth::user()->id)->get();

        if(!count($actas)){
            $exists_error = true;
            $errors[] = 'No se ha registrado ningún acta de posesión de nombramiento en el sistema.';
        }

        if($exists_error)
            return response($errors,422);

        return ['success'=>true];
    }

    public function basico(Request $request,$tramite){
        if($tramite == 'Trámite bancario' || $tramite == 'Acreditar experiencia') {
            Pdf::certificadoLaboralBasico(Auth::user(), $tramite);
        }

        return redirect('/');
    }

    public function solicitudCertificadoDetallado(RequestCertificadoDetallado $request){
        $configuracion = Configuracion::orderBy('id','DESC')->first();

        if($configuracion && $configuracion->correo_solicitud_certificados) {
            Correo::solicitudCertificadoLaboralDetallado($request,$configuracion);
            return ['success' => true];
        }else{
            return response(['destinatario'=>['Actualmente el sistema no se encuentra configurado correctamente, por favor intente luego']], 422);
        }
    }
}
