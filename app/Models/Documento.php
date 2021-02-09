<?php

namespace Archinet\Models;

use Archinet\Http\Controllers\ExpedienteController;
use Archinet\Http\Requests\RequestTipoDocumental;
use Archinet\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Documento extends Model
{
    protected $table = "documentos";

    protected $fillable = [
    ];

    public static function permitidos(){
        if(Auth::user()->esFuncionario()){
            return Documento::where('documentos.user_id',Auth::user()->id);
        }else if(Auth::user()->tieneFuncion(ExpedienteController::$IDENTIFICADOR_MODULO,'ver',ExpedienteController::$PRIVILEGIO_SUPERADMINISTRADOR)){
            return Documento::whereNotNull('documentos.id');
        }
        return Documento::whereNull('documentos.id');
    }

    public function metadatos(){
        return $this->hasOne(Metadato::class,'documento_id');
    }

    public function anexo(){
        return $this->belongsTo(Anexo::class,'documento_id');
    }

    public function documentoAnexo(){
        return $this->belongsTo(Documento::class,'documento_anexo_id');
    }

    public function archivo(){
        return $this->belongsTo(Archivo::class,'archivo_id');
    }

    public function fillAndSave(User $usuario, TipoDocumental $tipoDocumental, RequestTipoDocumental $request)
    {
        //se llenan los datos básicos
        $this->fecha_documento = $request->fecha_documento;
        $this->cantidad_folios = $request->cantidad_folios;
        $this->descripcion = $request->descripcion;
        $this->observaciones = $request->observaciones;
        $this->numero_folio = Documento::generarNumeroFolio($usuario);
        $this->user_id = $usuario->id;
        $this->user_creador_id = Auth::user()->id;
        $this->tipo_documental_id = $tipoDocumental->id;
        $this->save();

        $metadatos = new Metadato();
        //dependiento del tipo documental se crea y almacenan los metadaros

        //EDUCACION CAPACITACION Y EVALUACION DE DESEMPEÑO
        if ($tipoDocumental->carpeta == 'certificados_estudio_diplomas') {

            $metadatos->tipo = $request->tipo;
            $metadatos->nivel_estudio = $request->nivel_estudio;
            $metadatos->tipo_duracion = $request->tipo_duracion;
            $metadatos->duracion = $request->duracion;
            $metadatos->institucion = $request->institucion;
            $metadatos->graduado = $request->graduado;

            if($request->graduado == 'si') {
                $inicio_time = strtotime($request->fecha_inicio);
                $fin_time = strtotime($request->fecha_fin);

                if($inicio_time >= $fin_time)
                    return [
                        'success'=>false,
                        'errores'=>['fecha_inicio'=>['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha fin"']]
                    ];

                $metadatos->fecha_inicio = $request->fecha_inicio;
                $metadatos->fecha_fin = $request->fecha_fin;
            }

            if($request->tipo == 'Formal'){
                $metadatos->titulo_obtenido = $request->titulo_obtenido;
            }else{
                $metadatos->nombre_curso = $request->nombre_curso;
                $metadatos->nivel_estudio = $request->nivel_estudio_no_formal;
            }

            $metadatos->documento_id = $this->id;
            $metadatos->save();

        } elseif ($tipoDocumental->carpeta == 'evaluacion_desempenio') {

            $inicio_time = strtotime($request->fecha_inicio);
            $fin_time = strtotime($request->fecha_fin);

            if($inicio_time >= $fin_time)
                return [
                    'success'=>false,
                    'errores'=>['fecha_inicio'=>['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha fin"']]
                ];

            $metadatos->fecha_inicio = $request->fecha_inicio;
            $metadatos->fecha_fin = $request->fecha_fin;

            $metadatos->documento_id = $this->id;
            $metadatos->save();

        }
        //TRAYECTORIA LABORAL
        elseif ($tipoDocumental->carpeta == 'acta_posesion_nombramiento'){

            $metadatos->numero_acta = $request->numero_acta;
            $metadatos->fecha_nombramiento = $request->fecha_nombramiento;
            $metadatos->tipo_nombramiento = $request->tipo_nombramiento;
            $metadatos->tipo_novedad = $request->tipo_novedad;
            $metadatos->dependencia = $request->dependencia;
            $metadatos->cargo = $request->cargo;
            $metadatos->grado = $request->grado;
            $metadatos->salario = $request->salario;

            $metadatos->documento_id = $this->id;
            $metadatos->save();

        } elseif ($tipoDocumental->carpeta == 'certificaciones_laborales'){

            $metadatos->tipo = $request->tipo;

            $inicio_time = strtotime($request->fecha_vinculacion);
            $fin_time = strtotime($request->fecha_terminacion);

            if($inicio_time >= $fin_time)
                return [
                    'success'=>false,
                    'errores'=>['fecha_vinculacion'=>['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha terminación"']]
                ];
            $metadatos->fecha_vinculacion = $request->fecha_vinculacion;
            $metadatos->fecha_terminacion = $request->fecha_terminacion;
            $metadatos->asignacion_mensual = $request->asignacion_mensual;

            if($request->tipo == 'Externa'){
                $metadatos->empresa = $request->empresa;
                $metadatos->cargo_externa = $request->cargo_externa;
            }else{
                $metadatos->regional = $request->regional;
                $metadatos->tipo_nombramiento = $request->tipo_nombramiento;
                $metadatos->cargo = $request->cargo;
                $metadatos->grado = $request->grado;
            }

            $metadatos->documento_id = $this->id;
            $metadatos->save();

        }
        //VACACIONES LICENCIAS PERMISOS
        elseif ($tipoDocumental->carpeta == 'resoluciones_vacaciones'){

            $metadatos->no_resolucion = $request->no_resolucion;
            $metadatos->tipo = $request->tipo;
            $metadatos->no_dias_vacacionar = $request->no_dias_vacacionar;

            $inicio_time = strtotime($request->fecha_inicio);
            $fin_time = strtotime($request->fecha_fin);

            if($inicio_time >= $fin_time)
                return [
                    'success'=>false,
                    'errores'=>['fecha_inicio'=>['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha fin"']]
                ];

            $metadatos->fecha_inicio = $request->fecha_inicio;
            $metadatos->fecha_fin = $request->fecha_fin;

            $metadatos->documento_id = $this->id;
            $metadatos->save();

        } elseif ($tipoDocumental->carpeta == 'resoluciones_vacaciones_interrumpidas'){

            $metadatos->no_resolucion = $request->no_resolucion;
            $metadatos->no_resolucion_anterior = $request->no_resolucion_anterior;
            $metadatos->no_dias_no_vacacionados = $request->no_dias_no_vacacionados;

            $metadatos->documento_id = $this->id;
            $metadatos->save();

        }

        return ['success'=>true];
    }

    public static function generarNumeroFolio(User $user){
        $numero = 1;
        $ultimo_tipo_documental = Documento::where('user_id',$user->id)
            ->orderBy('id','DESC')
            ->first();
        if($ultimo_tipo_documental)$numero = $ultimo_tipo_documental->numero_folio + $ultimo_tipo_documental->cantidad_folios;

        return $numero;
    }

    public function tipoDocumental(){
        return $this->belongsTo(TipoDocumental::class,'tipo_documental_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function fillAndUpdate(RequestTipoDocumental $request)
    {
        //se llenan los datos básicos
        $this->fecha_documento = $request->fecha_documento;
        //$this->cantidad_folios = $request->cantidad_folios;
        $this->descripcion = $request->descripcion;
        $this->observaciones = $request->observaciones;
        $this->save();

        $tipoDocumental = $this->tipoDocumental;

        $metadatos = $this->metadatos;
        //dependiento del tipo documental se actualizan los metadaros

        //EDUCACION CAPACITACION Y EVALUACION DE DESEMPEÑO
        if ($tipoDocumental->carpeta == 'certificados_estudio_diplomas') {

            $metadatos->tipo = $request->tipo;
            $metadatos->nivel_estudio = $request->nivel_estudio;
            $metadatos->tipo_duracion = $request->tipo_duracion;
            $metadatos->duracion = $request->duracion;
            $metadatos->institucion = $request->institucion;
            $metadatos->graduado = $request->graduado;

            if($request->graduado == 'si') {
                $inicio_time = strtotime($request->fecha_inicio);
                $fin_time = strtotime($request->fecha_fin);

                if($inicio_time >= $fin_time)
                    return [
                        'success'=>false,
                        'errores'=>['fecha_inicio'=>['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha fin"']]
                    ];

                $metadatos->fecha_inicio = $request->fecha_inicio;
                $metadatos->fecha_fin = $request->fecha_fin;
            }else{
                $metadatos->fecha_inicio = null;
                $metadatos->fecha_fin = null;
            }

            if($request->tipo == 'Formal'){
                $metadatos->titulo_obtenido = $request->titulo_obtenido;
            }else{
                $metadatos->nombre_curso = $request->nombre_curso;
                $metadatos->nivel_estudio = $request->nivel_estudio_no_formal;
            }

            $metadatos->save();

        } elseif ($tipoDocumental->carpeta == 'evaluacion_desempenio') {

            $inicio_time = strtotime($request->fecha_inicio);
            $fin_time = strtotime($request->fecha_fin);

            if($inicio_time >= $fin_time)
                return [
                    'success'=>false,
                    'errores'=>['fecha_inicio'=>['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha fin"']]
                ];

            $metadatos->fecha_inicio = $request->fecha_inicio;
            $metadatos->fecha_fin = $request->fecha_fin;

            $metadatos->save();

        }
        //TRAYECTORIA LABORAL
        elseif ($tipoDocumental->carpeta == 'acta_posesion_nombramiento'){

            $metadatos->numero_acta = $request->numero_acta;
            $metadatos->fecha_nombramiento = $request->fecha_nombramiento;
            $metadatos->tipo_nombramiento = $request->tipo_nombramiento;
            $metadatos->tipo_novedad = $request->tipo_novedad;
            $metadatos->dependencia = $request->dependencia;
            $metadatos->cargo = $request->cargo;
            $metadatos->grado = $request->grado;
            $metadatos->salario = $request->salario;

            $metadatos->save();

        } elseif ($tipoDocumental->carpeta == 'certificaciones_laborales'){

            $metadatos->tipo = $request->tipo;

            $inicio_time = strtotime($request->fecha_vinculacion);
            $fin_time = strtotime($request->fecha_terminacion);

            if($inicio_time >= $fin_time)
                return [
                    'success'=>false,
                    'errores'=>['fecha_vinculacion'=>['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha terminación"']]
                ];
            $metadatos->fecha_vinculacion = $request->fecha_vinculacion;
            $metadatos->fecha_terminacion = $request->fecha_terminacion;
            $metadatos->asignacion_mensual = $request->asignacion_mensual;

            if($request->tipo == 'Externa'){
                $metadatos->empresa = $request->empresa;
                $metadatos->cargo_externa = $request->cargo_externa;
            }else{
                $metadatos->regional = $request->regional;
                $metadatos->tipo_nombramiento = $request->tipo_nombramiento;
                $metadatos->cargo = $request->cargo;
                $metadatos->grado = $request->grado;
            }

            $metadatos->save();

        }
        //VACACIONES LICENCIAS PERMISOS
        elseif ($tipoDocumental->carpeta == 'resoluciones_vacaciones'){

            $metadatos->no_resolucion = $request->no_resolucion;
            $metadatos->tipo = $request->tipo;
            $metadatos->no_dias_vacacionar = $request->no_dias_vacacionar;

            $inicio_time = strtotime($request->fecha_inicio);
            $fin_time = strtotime($request->fecha_fin);

            if($inicio_time >= $fin_time)
                return [
                    'success'=>false,
                    'errores'=>['fecha_inicio'=>['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha fin"']]
                ];

            $metadatos->fecha_inicio = $request->fecha_inicio;
            $metadatos->fecha_fin = $request->fecha_fin;

            $metadatos->save();

        } elseif ($tipoDocumental->carpeta == 'resoluciones_vacaciones_interrumpidas'){

            $metadatos->no_resolucion = $request->no_resolucion;
            $metadatos->no_resolucion_anterior = $request->no_resolucion_anterior;
            $metadatos->no_dias_no_vacacionados = $request->no_dias_no_vacacionados;

            $metadatos->save();

        }

        return ['success'=>true];
    }

    /**
     * Retorna todos los certificados laborales de un usuario
     *
     * @param $user_id
     */
    public static function certificacionesLaborales($user_id){
        return Documento::permitidos()
            ->select('documentos.*')
            ->join('metadatos','documentos.id','=','metadatos.documento_id')
            ->where('metadatos.tipo','Interna')
            ->whereNotNull('metadatos.fecha_vinculacion')
            ->whereNotNull('metadatos.fecha_terminacion')
            ->whereNotNull('metadatos.asignacion_mensual')
            ->whereNotNull('metadatos.regional')
            ->whereNotNull('metadatos.tipo_nombramiento')
            ->whereNotNull('metadatos.cargo')
            ->whereNotNull('metadatos.grado')
            ->where('documentos.user_id',$user_id);
    }

    /**
     * Retorna todos los certificados laborales de un usuario
     *
     * @param $user_id
     */
    public static function certificacionesLaboralesExternas($user_id){
        return Documento::permitidos()
            ->select('documentos.*')
            ->join('metadatos','documentos.id','=','metadatos.documento_id')
            ->where('metadatos.tipo','Externa')
            ->whereNotNull('metadatos.fecha_vinculacion')
            ->whereNotNull('metadatos.fecha_terminacion')
            ->whereNotNull('metadatos.cargo_externa')
            ->whereNotNull('metadatos.empresa')
            ->where('documentos.user_id',$user_id);
    }

    /**
     * Retorna todas las actas de posesion por nombramiento de un usuario
     *
     * @param $user_id
     */
    public static function actasPosesionNombramiento($user_id){
        return Documento::permitidos()
            ->select('documentos.*')
            ->join('metadatos','documentos.id','=','metadatos.documento_id')
            ->whereNotNull('metadatos.numero_acta')
            ->whereNotNull('metadatos.fecha_nombramiento')
            ->whereNotNull('metadatos.tipo_nombramiento')
            ->whereNotNull('metadatos.dependencia')
            ->whereNotNull('metadatos.cargo')
            ->whereNotNull('metadatos.grado')
            ->where('documentos.user_id',$user_id);
    }

    /**
     * Retorna todas los certificados de estudio de un usuario
     *
     * @param $user_id
     */
    public static function certificadosEstudio($user_id, $formal = true, $graduado = false){
        $return = Documento::permitidos()
            ->select('documentos.*')
            ->join('metadatos','documentos.id','=','metadatos.documento_id')
            ->whereNotNull('metadatos.nivel_estudio')
            ->whereNotNull('metadatos.tipo_duracion')
            ->whereNotNull('metadatos.duracion')
            ->whereNotNull('metadatos.institucion')
            ->whereNotNull('metadatos.graduado')
            ->where('documentos.user_id',$user_id);

        $tipo = $formal?'Formal':'No Formal';
        $return = $return->where('metadatos.tipo', $tipo);

        if($formal){
            $return = $return->whereNotNull('metadatos.titulo_obtenido');
        }
        if($graduado){
            $return = $return->where('metadatos.graduado',$graduado);
        }

        return $return;
    }

    /**
     * String de diferencia entre dos fechas
     *
     * @param $inicio
     * @param $fin
     */
    public function duracionStr($inicio,$fin){
        $inicio = strtotime($inicio);
        $fin = strtotime($fin);

        $dias = ($fin - $inicio)/(60*60*24);

        if($dias < 31){
            return $dias. (($dias == 1)?' día':' días');
        }

        if($dias < 365){
            $meses = intval($dias/31);
            $dias_restantes = intval($dias%31);

            $texto = $meses. (($meses == 1)?' mes':' meses');

            if($dias > 0){
                $texto .= ' '.$dias_restantes. (($dias_restantes == 1)?' día':' días');
            }

            return $texto;
        }

        $anios = intval($dias/365);
        $texto = $anios. (($anios == 1)?' año':' años');

        $dias_restantes = intval($dias%365);

        if($dias_restantes > 0) {
            $meses = intval($dias_restantes / 31);

            if ($meses == 0) {
                if ($dias_restantes > 0) {
                    $texto .= ' ' . $dias_restantes . (($dias_restantes == 1) ? ' día' : ' días');
                }
            }else{
                $texto .= ' '.$meses.(($meses == 1) ? ' mes' : ' meses');

                $dias_restantes = intval($dias_restantes % 31);

                if ($dias_restantes > 0) {
                    $texto .= ' ' . $dias_restantes . (($dias_restantes == 1) ? ' día' : ' días');
                }
            }

        }

        return $texto;
    }
}
