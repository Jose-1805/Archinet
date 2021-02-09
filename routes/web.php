<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    if(\Illuminate\Support\Facades\Auth::check())return redirect("/home");
    return view('bienvenido');
});

Auth::routes();

Route::get('/login', function () {
    return redirect('/');
})->name('login');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/create-password/{token}/{id}', "HomeController@createPassword");
    Route::post('/store-password', "HomeController@storePassword");
});

/**
 * TAREAS GENERALES DEL SISTEMA
 */
Route::group(['prefix' => 'tareas-sistema'],function () {
    Route::post('/select-departamentos', 'TareasSistemaController@selectDepartamentos');
    Route::post('/select-ciudades', 'TareasSistemaController@selectCiudades');
});

/**
 * AUTENTICADO
 */
Route::get('/home', function (){
    return redirect('/inicio');
});
Route::get('/inicio', 'HomeController@index');
Route::get('/api', 'ApiController@index');

/**
 * IMAGENES DEL SISTEMA
 */
Route::get('/almacen/{path}',function (\Illuminate\Http\Request $request, $path){
    $data = explode('-',$path);
    //desde esta url no se puede acceder a contenido almacenado en la carpeta restringido
    if($data[0] == 'restringido'){
        if($request->ajax())
            return response(['errors'=>['Unathorized.']],401);
        else
            return redirect()->back();
    }

    //si no se ha iniciado sesión solo se pueden ver archivos de la carpeta public
    if(\Illuminate\Support\Facades\Auth::guest()){
        if($data[0] != 'public'){
            if($request->ajax())
                return response(['errors'=>['Unathorized.']],401);
            else
                return redirect()->back();
        }
    }

    $path = storage_path() .'/app/'. str_replace('-','/', $path);
    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::group(['middleware' => ['auth','active']], function () {

    Route::get('bienvenida-usuario','HomeController@bienvenidaUsuario');
    /**
     * MODULOS Y FUNCIONES
     */
    Route::group(['prefix' => 'modulos-funciones'],function (){
        Route::get('/', 'ModulosFuncionesController@index');
        Route::post('/vista-modulos', 'ModulosFuncionesController@vistaModulos');
        Route::post('/vista-funciones', 'ModulosFuncionesController@vistaFunciones');
        Route::post('/actualizar-relacion', 'ModulosFuncionesController@actualizarRelacion');
        Route::post('/nuevo-modulo', 'ModulosFuncionesController@nuevoModulo');
        Route::post('/nueva-funcion', 'ModulosFuncionesController@nuevaFuncion');
        Route::post('form-modulo', 'ModulosFuncionesController@formModulo');
        Route::post('editar-modulo', 'ModulosFuncionesController@editarModulo');
        Route::post('form-funcion', 'ModulosFuncionesController@formFuncion');
        Route::post('editar-funcion', 'ModulosFuncionesController@editarFuncion');

    }
);

    /**
     * ROLES DEL SISTEMA
     */
    Route::group(['prefix' => 'rol'],function (){
        Route::get('/', 'RolController@index');
        Route::post('vista-roles', 'RolController@vistaRoles');
        Route::post('vista-privilegios', 'RolController@vistaPrivilegios');
        Route::post('crear', 'RolController@crear');
        Route::post('form', 'RolController@form');
        Route::post('editar', 'RolController@editar');
        Route::post('eliminar', 'RolController@eliminar');
    });

    /**
     *  USUARIOS
     */
    Route::group(['prefix' => 'usuario'],function (){
        Route::get('/', 'UsuarioController@index');
        Route::get('/lista', 'UsuarioController@lista');
        Route::get('/crear', 'UsuarioController@crear');
        Route::post('/guardar', 'UsuarioController@guardar');
        Route::get('/editar/{id}', 'UsuarioController@editar');
        Route::post('/actualizar', 'UsuarioController@actualizar');
        Route::post('/activar', 'UsuarioController@activar');
        Route::post('/desactivar', 'UsuarioController@desactivar');
    });
    //Expediente
    Route::group(['prefix' => 'expediente'],function (){
        Route::get('/lista', 'ExpedienteController@lista');
        Route::get('/listatiposdocumentales', 'ExpedienteController@listatiposdocumentales');
        Route::get('/crear', 'ExpedienteController@crear');
        Route::get('/{id?}', 'ExpedienteController@index');
        Route::post('/guardar', 'ExpedienteController@guardar');
        Route::get('/editar/{id}', 'ExpedienteController@editar');
        Route::get('/seccion/{id}', 'ExpedienteController@seccion');
        Route::post('/actualizar', 'ExpedienteController@actualizar');
        Route::get('/seccion/{seccion}/{id}', 'ExpedienteController@seccion');
        Route::post('/form-tipo-documental', 'ExpedienteController@formTipoDocumental');
        Route::post('/guardar-tipo-documental', 'ExpedienteController@guardarTipoDocumental');
        Route::post('/validar-documento/{id}', 'ExpedienteController@validarDocumento');
        Route::post('/datos-documento', 'ExpedienteController@datosDocumento');
        Route::get('/ver-documento/{id}', 'ExpedienteController@verDocumento');
        Route::post('/form-editar-documento', 'ExpedienteController@formEditarDocumento');
        Route::post('/editar-documento', 'ExpedienteController@editarDocumento');
        Route::post('import', 'ImportController@import');
        Route::get('/hoja-vida/{id}', 'ExpedienteController@hojaVida');
    });

    //Eventos Log
    Route::group(['prefix' => 'historial_eventos'],function (){
        Route::get('/', 'HistorialEventoController@index');
        Route::get('listaEventos', 'HistorialEventoController@listaEventos');
        Route::get('/exportar/{modulo?}/{actividad?}', 'HistorialEventoController@exportar');
    });

    /**
     * CONFIGURACION DEL SISTEMA
     */
    Route::group(['prefix' => 'configuracion'],function (){
        Route::get('/', 'ConfiguracionController@index');
        Route::post('/cambiar-password', 'ConfiguracionController@cambiarPassword');
        Route::post('/correos', 'ConfiguracionController@correos');
    });



    /**
     * TIPOS DOCUMENTALES
     */
    Route::group(['prefix' => 'tipo-documental'],function (){
        Route::get('/', 'TipoDocumentalController@index');
        Route::post('guardar', 'TipoDocumentalController@guardar');
        Route::post('form', 'TipoDocumentalController@form');
        Route::post('editar', 'TipoDocumentalController@editar');
        Route::get('lista', 'TipoDocumentalController@lista');
    });



    /**
     * CERTIFICADOS
     */
    Route::group(['prefix' => 'certificado'], function (){
        Route::get('/', 'CertificadoController@index');
        Route::post('/validar-requisitos', 'CertificadoController@validarRequisitos');
        Route::get('/basico/{tramite}', 'CertificadoController@basico');
        Route::post('/solicitud-certificado-detallado', 'CertificadoController@solicitudCertificadoDetallado');
    });
});


