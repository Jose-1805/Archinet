<?php

namespace Archinet\Models;

use Archinet\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    protected $table = "logs";

    protected $fillable = [
        'tipo',
        'modulo',
        'registro_afectado',
        'registro_nuevo',
        'registro_anterior',
        'user_id',
        'rol_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }


    /**
     * Convierte la cadena que representa los datos del registro afectado en un array
     *
     * @param bool $agregar_nulos // indica si se deben agregar los campos que esten vacios o nulos
     */
    public function registroNuevoToArray($agregar_nulos = false)
    {
        $data = explode('/*/', $this->registro_nuevo);
        $result = [];
        foreach ($data as $d) {
            $informacion = explode('=>', $d);
            if (count($informacion) == 2) {
                if ($informacion[1] != null && $informacion[1] != '' || $agregar_nulos) {
                    $result[$informacion[0]] = $informacion[1];

                    //si el item es de privilegios de roles se envia también como string
                    if ($this->modulo == 'Roles' && $informacion[0] == 'privilegios') {
                        $result['privilegios_str'] = Rol::strPrivilegios($informacion[1]);
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Convierte la cadena que representa los datos del registro anterior en un array
     *
     * @param bool $agregar_nulos // indica si se deben agregar los campos que esten vacios o nulos
     */
    public function registroAnteriorToArray($agregar_nulos = false)
    {
        $data = explode('/*/', $this->registro_anterior);
        $result = [];
        foreach ($data as $d) {
            $informacion = explode('=>', $d);
            if (count($informacion) == 2) {
                if ($informacion[1] != null && $informacion[1] != '' || $agregar_nulos) {
                    $result[$informacion[0]] = $informacion[1];

                    //si el item es de privilegios de roles se envia también como string
                    if ($this->modulo == 'Roles' && $informacion[0] == 'privilegios') {
                        $result['privilegios_str'] = Rol::strPrivilegios($informacion[1]);
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Retorna un array con los campos que son diferentes en el registro nuevo y el anterior
     */
    public function getDiferencias()
    {
        $registro_anterior = $this->registroAnteriorToArray(true);
        $registro_nuevo = $this->registroNuevoToArray(true);

        $diferencias = [];

        foreach ($registro_anterior as $key => $value) {
            //si no se envuentra el key en el array de registro nuevo
            //o si existe en el registro nuevo pero el valor es diferente al antiguo
            if (!array_key_exists($key, $registro_nuevo)
                || (array_key_exists($key, $registro_nuevo) && $registro_nuevo[$key] != $value)) {

                if (!array_key_exists($key, $diferencias)) {
                    $anterior = $value;
                    $nuevo = array_key_exists($key, $registro_nuevo) ? $registro_nuevo[$key] : '';

                    if ($anterior != $nuevo) {
                        $diferencias[$key] = [
                            'anterior' => $anterior,
                            'nuevo' => $nuevo
                        ];
                    }
                }
            }
        }
        
        foreach ($registro_nuevo as $key => $value) {
            //si no se envuentra el key en el array de registro anterior
            //o si existe en el registro anterior pero el valor es diferente al antiguo
            if (!array_key_exists($key, $registro_anterior)
                || (array_key_exists($key, $registro_anterior) && $registro_anterior[$key] != $value)) {

                if (!array_key_exists($key, $diferencias)) {
                    $anterior = array_key_exists($key, $registro_anterior) ? $registro_anterior[$key] : '';
                    $nuevo = $value;

                    if ($anterior != $nuevo) {
                        $diferencias[$key] = [
                            'anterior' => $anterior,
                            'nuevo' => $nuevo
                        ];
                    }
                }
            }
        }

        return $diferencias;
    }

    public function printDiferencias($nuevo = true, $separador = ':')
    {
        $diferencias = $this->getDiferencias();
        $strPrint = '';
        $except = ['updated_at', 'created_at', 'id', 'privilegios', 'user_id', 'user_creador_id', 'tipo_documental_id', 'archivo_id', 'documento_id'];

        foreach ($diferencias as $key => $value) {
            if (!in_array($key, $except)) {
                if ($key == 'privilegios_str') $key = 'privilegios';
                if ($nuevo) {
                    $strPrint .= $key . ' ' . $separador . ' ' . $value['nuevo'] . '<br>';
                } else {
                    $strPrint .= $key . ' ' . $separador . ' ' . $value['anterior'] . '<br>';
                }
            }
        }
        return $strPrint;
    }

    public function printDiferenciasJSON($nuevo = true, $separador = ':')
    {
        $diferencias = $this->getDiferencias();
        $strJSON = "[";
        $except = ['updated_at', 'created_at', 'id', 'user_id', 'user_creador_id', 'tipo_documental_id', 'archivo_id', 'documento_id'];
        $v = false;
        foreach ($diferencias as $key => $value) {
            if (!in_array($key, $except)) {
                if ($v) {
                    $strJSON .= ",";
                } else {
                    $v = true;
                }
                if ($key == 'privilegios'){
                    $value['nuevo'] = Rol::strPrivilegios($value['nuevo']);
                    $value['anterior'] = Rol::strPrivilegios($value['anterior']);
                } 
                $strJSON .= '{"nuevo":"'.$value['nuevo'].'","anterior":"'.$value['anterior'].'", "campo":"'.$key.'"}';
            }
        }
        return $strJSON . "]";
    }


    //<editor-fold desc="Almacenamiento de logs de inicio y cierre de sesion">
    public static function inicioSesion(Login $event)
    {
        $user = $event->user;

        $rol = $user->roles()->first();

        $data = [
            'tipo' => 'Inicio sesión',
            'modulo' => 'Usuarios',
            'registro_afectado' => $user->tipo_identificacion . ' ' . $user->identificacion,
            'user_id' => $user->id,
            'rol_id' => $rol->id
        ];

        Log::create($data);
    }

    public static function cierreSesion(Logout $event)
    {
        $user = $event->user;

        $rol = $user->roles()->first();

        $data = [
            'tipo' => 'Cierre sesión',
            'modulo' => 'Usuarios',
            'registro_afectado' => $user->tipo_identificacion . ' ' . $user->identificacion,
            'user_id' => $user->id,
            'rol_id' => $rol->id
        ];

        Log::create($data);
    }
    //</editor-fold>

    //<editor-fold desc="Almacenamiento de logs de CU de usuarios">
    public static function createUser(User $user)
    {
        $rol = session('rol');
        $data = [
            'tipo' => 'Crear',
            'modulo' => 'Usuarios',
            'registro_afectado' => $user->tipo_identificacion . ' ' . $user->identificacion,
            'registro_nuevo' => $user->implodeModel(),
            'registro_anterior',
            'user_id' => Auth::user()->id,
            'rol_id' => $rol->id,
        ];
        Log::create($data);
    }

    public static function updateUser(User $userOld, User $userNew)
    {
        $rol = session('rol');
        $data = [
            'tipo' => 'Editar',
            'modulo' => 'Usuarios',
            'registro_afectado' => $userNew->tipo_identificacion . ' ' . $userNew->identificacion,
            'registro_nuevo' => $userNew->implodeModel(),
            'registro_anterior' => $userOld->implodeModel(),
            'user_id' => Auth::user()->id,
            'rol_id' => $rol->id,
        ];
        Log::create($data);
    }
    //</editor-fold>

    //<editor-fold desc="Almacenamiento de logs de CU de funcionarios">
    public static function createExpeiente(User $user)
    {
        $rol = session('rol');
        $data = [
            'tipo' => 'Crear',
            'modulo' => 'Expedientes',
            'registro_afectado' => $user->tipo_identificacion . ' ' . $user->identificacion,
            'registro_nuevo' => $user->implodeModel(),
            'registro_anterior',
            'user_id' => Auth::user()->id,
            'rol_id' => $rol->id,
        ];
        Log::create($data);
    }

    public static function updateExpeiente(User $userOld, User $userNew)
    {
        $rol = session('rol');
        $data = [
            'tipo' => 'Editar',
            'modulo' => 'Expedientes',
            'registro_afectado' => $userNew->tipo_identificacion . ' ' . $userNew->identificacion,
            'registro_nuevo' => $userNew->implodeModel(),
            'registro_anterior' => $userOld->implodeModel(),
            'user_id' => Auth::user()->id,
            'rol_id' => $rol->id,
        ];
        Log::create($data);
    }
    //</editor-fold>

    //<editor-fold desc="Almacenamiento de logs de CUD de roles">
    public static function createRol(Rol $rol)
    {
        $rol_auth = session('rol');
        $data = [
            'tipo' => 'Crear',
            'modulo' => 'Roles',
            'registro_afectado' => $rol->nombre,
            'registro_nuevo' => $rol->implodeModel(),
            'registro_anterior',
            'user_id' => Auth::user()->id,
            'rol_id' => $rol_auth->id,
        ];
        Log::create($data);
    }

    public static function updateRol(Rol $rolOld, Rol $rolNew)
    {
        $rol_auth = session('rol');
        $data = [
            'tipo' => 'Editar',
            'modulo' => 'Roles',
            'registro_afectado' => $rolNew->nombre,
            'registro_nuevo' => $rolNew->implodeModel(),
            'registro_anterior' => $rolOld->implodeModel(),
            'user_id' => Auth::user()->id,
            'rol_id' => $rol_auth->id,
        ];
        Log::create($data);
    }

    public static function deleteRol(Rol $rol)
    {
        $rol_auth = session('rol');
        $data = [
            'tipo' => 'Eliminar',
            'modulo' => 'Roles',
            'registro_afectado' => $rol->nombre,
            'registro_anterior' => $rol->implodeModel(),
            'user_id' => Auth::user()->id,
            'rol_id' => $rol_auth->id,
        ];
        Log::create($data);
    }
    //</editor-fold>

    //<editor-fold desc="Almacenamiento de logs de CU de tipos documentales">
    public static function createTipoDocumental(Documento $documento)
    {
        $rol_auth = session('rol');
        $user = $documento->user;

        $implode = $documento->implodeModel();
        $metadatos = $documento->metadatos;
        $archivo = $documento->archivo;

        if($metadatos)
            $implode .= '/*/' . $metadatos->implodeModel(['id']);

        $implode .= '/*/nombre_archivo=>' . $archivo->nombre;

        $tipo_documental = $documento->tipoDocumental;
        $data = [
            'tipo' => 'Crear tipo documental',
            'modulo' => 'Expedientes',
            'registro_afectado' => $user->identificacion . ' (' . $tipo_documental->nombre . ')',
            'registro_nuevo' => $implode,
            'registro_anterior',
            'user_id' => Auth::user()->id,
            'rol_id' => $rol_auth->id,
        ];
        Log::create($data);
    }

    public static function updateTipoDocumental(Documento $documento_nuevo, Metadato $metadatos_nuevos, Documento $documento_anterior, Archivo $archivo_nuevo, Metadato $metadatos_anteriores, Archivo $archivo_anterior)
    {
        $rol_auth = session('rol');
        $user = $documento_nuevo->user;

        $implode_nuevo = $documento_nuevo->implodeModel();
        $implode_nuevo .= '/*/' . $metadatos_nuevos->implodeModel(['id']);
        $implode_nuevo .= '/*/nombre_archivo=>' . $archivo_nuevo->nombre;

        $implode_anterior = $documento_anterior->implodeModel();
        $implode_anterior .= '/*/' . $metadatos_anteriores->implodeModel(['id']);
        $implode_anterior .= '/*/nombre_archivo=>' . $archivo_anterior->nombre;

        $tipo_documental = $documento_nuevo->tipoDocumental;
        $data = [
            'tipo' => 'Editar tipo documental',
            'modulo' => 'Expedientes',
            'registro_afectado' => $user->identificacion . ' (' . $tipo_documental->nombre . ')',
            'registro_nuevo' => $implode_nuevo,
            'registro_anterior' => $implode_anterior,
            'user_id' => Auth::user()->id,
            'rol_id' => $rol_auth->id,
        ];
        Log::create($data);
    }

    public static function validarTipoDocumental(Documento $documento)
    {
        $rol_auth = session('rol');
        $user = $documento->user;
        $tipo_documental = $documento->tipoDocumental;
        $data = [
            'tipo' => 'Validar tipo documental',
            'modulo' => 'Expedientes',
            'registro_afectado' => $user->identificacion . ' (' . $tipo_documental->nombre . ')',
            'registro_nuevo' => '',
            'registro_anterior' => '',
            'user_id' => Auth::user()->id,
            'rol_id' => $rol_auth->id,
        ];
        Log::create($data);
    }

    //</editor-fold>

    //<editor-fold desc="Almacenamiento de logs de CU de tipos documentales">
    public static function createGestionTipoDocumental(TipoDocumental $tipo_documental)
    {
        $rol_auth = session('rol');

        $implode = $tipo_documental->implodeModel();

        $data = [
            'tipo' => 'Crear',
            'modulo' => 'Tipos documentales',
            'registro_afectado' => $tipo_documental->nombre,
            'registro_nuevo' => $implode,
            'registro_anterior',
            'user_id' => Auth::user()->id,
            'rol_id' => $rol_auth->id,
        ];
        Log::create($data);
    }

    public static function updateGestionTipoDocumental(TipoDocumental $tipo_documental_nuevo, TipoDocumental $tipo_documental_anterior)
    {
        $rol_auth = session('rol');

        $implode = $tipo_documental_nuevo->implodeModel();
        $implode_anterior = $tipo_documental_anterior->implodeModel();

        $data = [
            'tipo' => 'Editar',
            'modulo' => 'Tipos documentales',
            'registro_afectado' => $tipo_documental_nuevo->nombre,
            'registro_nuevo' => $implode,
            'registro_anterior' => $implode_anterior,
            'user_id' => Auth::user()->id,
            'rol_id' => $rol_auth->id,
        ];
        Log::create($data);
    }
    //</editor-fold>
}