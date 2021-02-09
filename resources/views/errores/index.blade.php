<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name', 'Archinet') }}</title>

    <link href="{{asset('css/helpers.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('MDB-Free/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('MDB-Free/css/mdb.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/global.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/paginaprincipal.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/principal.css')}}" rel="stylesheet" type="text/css">

    <style>
        /* Required for full background image */

        html,
        body,
        header,
        .view {
            height: 100%;
        }

        @media (max-width: 740px) {
            html,
            body,
            header,
            .view {
                height: 1100px;
            }
        }
        @media (min-width: 800px) and (max-width: 850px) {
            html,
            body,
            header,
            .view {
                height: 700px;
            }
        }
        .footer {
            position: static;
            height: auto;
            padding: 3rem 3rem;
        }
    </style>
</head>

<body>
<header>
    <div class="view" style="background-image: url('{{asset('imagenes/bienvenido/slider.jpg')}}'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-10 offset-md-1 align-items-center">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-3 no-padding">
                                <a href="{{url('/')}}"><img class="right" src="{{asset('imagenes/logos/logo_sena_blanco.png')}}" style="height: 120px; margin: 1cm;" alt="Logo SENA"/></a>
                            </div>
                            <div style="background-color: #FFF;height: 80px;width: 1px;"></div>
                            <div class="col white-text no-padding">
                                <h1 class="white-text" style="padding-left: 1cm;">{{$mensaje}}</h1>
                                <h2 class="white-text" style="padding-left: 1cm;">Código de error: {{$estado}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div>
    @yield("body")
</div>

@include('layouts.secciones.footer')

<input type="hidden" id="general_url" value="{{url('/')}}">
<input type="hidden" id="general_token" value="{{csrf_token()}}">

<script src="{{asset('MDB-Free/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('MDB-Free/js/bootstrap.js')}}"></script>
<script src="{{asset('MDB-Free/js/mdb.js')}}"></script>
<script src="{{asset('js/numeric.js')}}"></script>
<script src="{{asset('js/bienvenido.js')}}"></script>
<script src="{{asset('js/blockUi.js')}}"></script>>
<script src="{{asset('js/global.js')}}"></script>
@stack('js')
</body>
</html>