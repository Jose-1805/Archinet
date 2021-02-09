@extends('layouts.app')

@section('css')
    @parent

    <link href="{{asset('css/configuracion.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Configuraciones</p>

            <div class="col-12 no-padding">
                @include('layouts.alertas',['id_contenedor'=>'alertas-configuraciones'])
            </div>

            <a class="opcion-configuracion border hoverable col-6 col-sm-4 col-md-3 col-lg-2" href="#!" data-toggle="modal" data-target="#modal-contrasena">
                <div class="col-xs-12 text-center padding-bottom-10 padding-top-10">
                    <i class="fa fa-unlock-alt fa-3x" style="padding-bottom: 4px;"></i>
                </div>
                <p class="text-center col-xs-12 truncate no-padding">Contraseña</p>
            </a>

            @if(Auth::user()->tieneFuncion(\Archinet\Http\Controllers\TipoDocumentalController::$IDENTIFICADOR_MODULO,'ver',\Archinet\Http\Controllers\TipoDocumentalController::$PRIVILEGIO_SUPERADMINISTRADOR))
                <a class="opcion-configuracion border hoverable col-6 col-sm-4 col-md-3 col-lg-2" href="{{url('/tipo-documental')}}">
                    <div class="col-xs-12 text-center padding-bottom-10 padding-top-10">
                        <i class="fas fa-folder-plus fa-3x" style="padding-bottom: 4px;"></i>
                    </div>
                    <p class="text-center col-xs-12 truncate no-padding">Tipos documentales</p>
                </a>
            @endif


            @if(Auth::user()->esSuperadministrador())
                <a class="opcion-configuracion border hoverable col-6 col-sm-4 col-md-3 col-lg-2" href="#!" data-toggle="modal" data-target="#modal-correos">
                    <div class="col-xs-12 text-center padding-bottom-10 padding-top-10">
                        <i class="fa fa-envelope fa-3x" style="padding-bottom: 4px;"></i>
                    </div>
                    <p class="text-center col-xs-12 truncate no-padding">Correos</p>
                </a>
            @endif
        </div>
    </div>

    @include('configuracion.modales')
@endsection

@push('js')
    <script src="{{asset('js/configuracion/index.js')}}"></script>
@endpush
