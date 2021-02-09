<?php

namespace Archinet\Http\Controllers;

use Archinet\Http\Requests\RequestRegistro;
use Archinet\Http\Requests\RequestRegistroHistorial;
use Archinet\Models\Ciudad;
use Archinet\Models\Departamento;
use Archinet\Models\Registro;
use Archinet\Models\RegistroHistorial;
use Archinet\Models\Rol;
use Archinet\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Facades\Datatables;

class TareasSistemaController extends Controller
{
    public $privilegio_superadministrador = true;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    public function selectDepartamentos(Request $request){
        $departamentos = [''=>'Seleccione un departamento']+Departamento::pluck('nombre','id')->toArray();
        $name = 'departamento';
        if($request->has('pais')){
            $departamentos = [''=>'Seleccione un departamento']+Departamento::where('pais_id',$request->input('pais'))->pluck('nombre','id')->toArray();
        }

        if($request->has('name'))$name = $request->input('name');

        return view('layouts.componentes.select')
            ->with('elementos',$departamentos)
            ->with('name',$name)->render();
    }

    public function selectCiudades(Request $request){
        $ciudades = [''=>'Seleccione una ciudad']+Ciudad::pluck('nombre','id')->toArray();
        $name = 'ciudad';
        if($request->has('departamento')){
            $ciudades = [''=>'Seleccione una ciudad']+Ciudad::where('departamento_id',$request->input('departamento'))->pluck('nombre','id')->toArray();
        }

        if($request->has('name'))$name = $request->input('name');

        return view('layouts.componentes.select')
            ->with('elementos',$ciudades)
            ->with('name',$name)->render();
    }
}
