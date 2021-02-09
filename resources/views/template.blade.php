<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Archinet') }}</title>
    <link href="{{asset('MDB-Free/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/principal.css')}}" rel="stylesheet" type="text/css"/>
    @stack('css')
</head>

<body>
<div class="contenedor-principal">
    <div class="barrasuperior">

    </div>
    <div class="row headerPrincipal full">

        <div class="logo-sena col-sm-3 d-none d-sm-block">
            <img class="logosena" src="imagenes/logos/logo_sena.png" alt=""/>
            <div class="border-lado"></div>
        </div>
        <div class="titulo-principal col-sm-6">
            <P>PROTOTIPO PARA LA GESTIÓN DE HISTORIA LABORAL</P>
        </div>
        <div class="logo-archinet col-sm-3 d-none d-sm-block">
            <img class="logoarchinet" src="imagenes/logos/logoarchinet.png" alt=""/>
        </div>
    </div>
    <div class="row contenido-principal full">

        @yield("body")

        @if(Auth::guest())
            @include('bienvenido.modales')
        @endif
    </div>
    <div class=" row footer full">
        @include('layouts.secciones.footer')
    </div>
</div>
<input type="hidden" id="general_url" value="{{url('/')}}">
<input type="hidden" id="general_token" value="{{csrf_token()}}">
<script src="{{asset('MDB-Free/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('MDB-Free/js/bootstrap.js')}}"></script>
<script src="{{asset('js/principal.js')}}" type="text/javascript"></script>
@stack('js')
</body>
</html>