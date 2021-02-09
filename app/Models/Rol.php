<?php

namespace Archinet\Models;

use Archinet\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Rol extends Model
{
    protected $table = "roles";

    protected $fillable = [
        'superadministrador',
        'nombre',
        'privilegios',
        'veterinarias',
        'entidades',
        'registros',
        'user_id',
    ];

    public static function permitidos()
    {
        return Rol::whereNotNull('id');
    }

    /**
     * Retorna un array con la información de los privilegios convertida a texto
     *
     * [
     *   'numero_identificador' => [
     *      'nombre'=>'etiqueta_modulo',
     *      'funciones'=>
     *          [
     *              0 => 'Nombre_funcion_!',
     *              1 => 'Nombre_funcion_2',
     *              2 => 'Nombre_funcion_...',
     *          ],
     *
     *   ]
     * ]
     */
    public function dataPrivilegios(){
        $privilegios = $this->privilegios;

        $data = explode('_',$privilegios);
        $data_return = [];
        //dd($data[0]);
        if(count($data) >= 1 && $data[0]) {
            for ($i = 0; $i < count($data); $i++) {
                //se quitan los caracteres '(' y ')' para pasar de (1,2) a 1,2
                $str_privilegio = trim($data[$i], '(');
                $str_privilegio = trim($str_privilegio, ')');
                // se separa en un array por la coma
                $data_privilegio = explode(',', $str_privilegio);
                $modulo = Modulo::where('identificador', $data_privilegio[0])->first();

                if (!array_key_exists($modulo->identificador, $data_return)) {
                    $data_return[$modulo->identificador] = [
                        'identificador'=>$modulo->identificador,
                        'nombre' => $modulo->nombre,
                        'etiqueta' => $modulo->etiqueta,
                        'url' => $modulo->url,
                        'estado' => $modulo->estado,
                        'agrupacion' => $modulo->agrupacion,
                        'orden_menu' => $modulo->orden_menu,
                        'funciones' => [],
                    ];
                }

                $funcion = Funcion::where('identificador', $data_privilegio[1])->first();
                $data_return[$modulo->identificador]['funciones'][] = $funcion->nombre;
            }
        }
        return $data_return;
    }

    public static function strPrivilegios($privilegios){
        $data = explode('_',$privilegios);
        $data_modulo = [];
        //dd($data[0]);
        if(count($data) >= 1 && $data[0]) {
            for ($i = 0; $i < count($data); $i++) {
                //se quitan los caracteres '(' y ')' para pasar de (1,2) a 1,2
                $str_privilegio = trim($data[$i], '(');
                $str_privilegio = trim($str_privilegio, ')');
                // se separa en un array por la coma
                $data_privilegio = explode(',', $str_privilegio);
                $modulo = Modulo::where('identificador', $data_privilegio[0])->first();

                if (!array_key_exists($modulo->identificador, $data_modulo)) {
                    $data_modulo[$modulo->identificador] = [
                        'identificador'=>$modulo->identificador,
                        'nombre' => $modulo->nombre,
                        'etiqueta' => $modulo->etiqueta,
                        'url' => $modulo->url,
                        'estado' => $modulo->estado,
                        'agrupacion' => $modulo->agrupacion,
                        'orden_menu' => $modulo->orden_menu,
                        'funciones' => [],
                    ];
                }

                $funcion = Funcion::where('identificador', $data_privilegio[1])->first();
                $data_modulo[$modulo->identificador]['funciones'][] = $funcion->nombre;
            }
        }

        $str_privilegios = '';
        foreach ($data_modulo as $d){
            $str_privilegios .= $d['etiqueta'].'(';
            foreach ($d['funciones'] as $f){
                $str_privilegios .= $f.', ';
            }
            $str_privilegios = trim($str_privilegios,', ');
            $str_privilegios .= ') _ ';
        }

        $str_privilegios = trim($str_privilegios,' _ ');
        return $str_privilegios;
    }

    public function tieneFuncion($identificador_modulo,$identificador_funcion){
        $permisos = $this->privilegios;
        if($permisos) {
            $modulo = Modulo::where('identificador', $identificador_modulo)->first();
            $funcion = Funcion::where('identificador', $identificador_funcion)->first();

            if ($modulo && $funcion && $modulo->tieneFuncion($funcion->id)) {
                $result = ''.strpos($permisos, '(' . $identificador_modulo . ',' . $identificador_funcion . ')');

                if ($result != '')
                    return true;
            }
        }

        return false;
    }

    public static function funcionario(){
        return Rol::where('roles.funcionario','si')->first();
    }

    public function usuarios(){
        return $this->belongsToMany(User::class,'roles_users','rol_id','user_id');
    }
}
