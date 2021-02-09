<?php

namespace Archinet;

use Archinet\Models\Afiliacion;
use Archinet\Models\Funcion;
use Archinet\Models\Archivo;
use Archinet\Models\Mascota;
use Archinet\Models\Modulo;
use Archinet\Models\Rol;
use Archinet\Models\SolicitudAfiliacion;
use Archinet\Models\Ubicacion;
use Archinet\Models\Veterinaria;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use phpseclib\Crypt\Hash;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_identificacion',
        'identificacion',
        'nombres',
        'apellidos',
        'celular',
        'direccion',
        'telefono_opcional',
        'email',
        'email_opcional',
        'fecha_inicio_contrato',
        'fecha_terminacion_contrato',
        'fecha_nacimiento',
        'direccion',
        'estado',
        'estado_civil',
        'rol_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function permitidos(){
        return User::whereNotNull('users.id');
    }

    public function roles(){
        return $this->belongsToMany(Rol::class,'roles_users','user_id','rol_id');
    }

    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class,'ubicacion_id');
    }

    public function imagenPerfil(){
        return $this->belongsTo(Archivo::class,'imagen_id');
    }

    public function esSuperadministrador(){
        if(session('rol')->superadministrador == "si")return true;
        return false;
    }

    /**
     * Consulta si un usuario tiene un modulo asignado a su rol
     *
     * @param $identificador -> identificador unico del modulo
     * @return bool
     */
    public function tieneModulo($identificador){
        $permisos = session('rol')->privilegios;

        if(is_numeric(strpos($permisos,'('.$identificador.',')))
            return true;

        return false;

    }

    public function tieneFuncion($identificador_modulo,$nombre_funcion,$privilegio_superadministrador){

        $identificador_funcion = config('params')['funciones'][strtolower($nombre_funcion)];
        if($privilegio_superadministrador && $this->esSuperadministrador()){
            return true;
        }

        $permisos = session('rol')->privilegios;
        $modulo = Modulo::where('identificador',$identificador_modulo)->first();
        $funcion = Funcion::where('identificador',$identificador_funcion)->first();

        if($modulo && $funcion && $modulo->tieneFuncion($funcion->id) && $modulo->estado == 'Activo') {
            $result = ''.strpos($permisos,'(' . $identificador_modulo . ',' . $identificador_funcion . ')');
            if ( $result != '')
                return true;
        }

        return false;

    }

    /**
     * Determina si un usuario tiene habilitadas funciones especificas o una de ellas
     *
     * @param $identificador_modulo
     * @param $funciones => Array con los identificadores de las funciones que se necesitan
     * @param $all => Determina si para retornar verdadero se debe tener todas las funciones o por lo menos una
     * @param $privilegio_superadministrador => Determina si se aplica Excepcion cuando el rol del usuario es superadministrador
     */
    public function tieneFunciones($identificador_modulo,$funciones,$all,$privilegio_superadministrador){
        $return = true;

        for ($i = 0; $i < count($funciones);$i++){
            if($this->tieneFuncion($identificador_modulo,$funciones[$i],$privilegio_superadministrador)){
                if(!$all){
                    return true;
                }else{
                    $return = true;
                }
            }else{
                if($all){
                    return false;
                }else{
                    $return = false;
                }
            }
        }
        return $return;
    }

    public function generarPassword($save = false){
        $cadena = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $password = "";
        $lengh = rand(10,20);
        for($i = 0;$i < $lengh;$i++){
            $password .= $cadena[rand(0,strlen($cadena)-1)];
        }
        $this->password = Hash::make($password);
        if($save)$this->save();
        return $password;
    }

    public function fullName(){
        return $this->nombres.' '.$this->apellidos;
    }

    /**
     * Define si el usuario relacionado con el objeto
     * tiene activas todas las dependencias necesarias para su funcionamiento
     *
     *
     */
    public function dependenciasActivas(){
        if($this->estado == 'activo'){
            $roles = $this->roles()->select('roles.id','roles_users.estado')->get();
            if(count($roles)){
                $rol_activo = false;
                foreach ($roles as $rol){
                    if($rol->estado == 'activo'){
                        $rol_activo = true;
                        break;
                    }
                }
                if($rol_activo)return true;
            }
        }
        return false;
    }

    function esFuncionario(){
        $rol = $this->roles()->where('funcionario','si')->first();
        return $rol?true:false;
    }
}
