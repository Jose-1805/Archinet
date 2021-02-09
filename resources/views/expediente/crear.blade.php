@extends('layouts.app')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/usuarios/crear.css')}}">
@endpush
@section('content')
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Crear Expediente</p>
            <p class="obligatorio margin-bottom-20">Los campos marcados con (*) son obligatorios</p>
            <div class="col-12 usuarios no-padding">
                @include('expediente.form')
            </div>
        </div>
        <div class="row">
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('js/expediente/crear.js')}}"></script>
@endpush
