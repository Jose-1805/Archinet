@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/usuarios/crear.css')}}">
@endpush
@section('content')
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal">Editar usuario</p>
            <p class="obligatorio margin-bottom-20">Los campos marcados con (*) son obligatorios</p>
            <div class="col-12 usuarios">
                @include('layouts.alertas',['id_contenedor'=>'alertas-editar-usuario'])
            </div>
            <div class="col-12 no-padding">
                @php($usuario->rol = $usuario->roles()->first()->id)
                {!! Form::model($usuario,['id'=>'form-usuario']) !!}
                    {!! Form::hidden('usuario',$usuario->id,['id'=>'usuario']) !!}
                    @include('usuario.form')
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection

@push('js')

    <script src="{{asset('js/usuario/editar.js')}}"></script>
@endpush
