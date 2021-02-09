@extends('layouts.app_guest')

@section('form')
    <div class="card">
        <div class="card-body">
            <div class="">
                <h3 class="dark-grey-text">
                    <strong class="">Bienvenido a {{ config('app.name','nuestro sistema') }}!</strong>
                </h3>
            </div>
            <hr>

            <div class="">
                @include('layouts.alertas',['id_contenedor'=>'alertas-create-password'])
            </div>

            <div class="">
                <p class="">Señor(a) {{$user->fullName()}}, para ingresar al sistema ingrese una contraseña de acceso y la verificación de la misma.</p>
                {!! Form::open(['id'=>'form-create-password']) !!}
                <div class="">
                    <div class="md-form">
                        {!! Form::label('password','Contraseña (*)') !!}
                        {!! Form::password('password',['id'=>'password','class'=>'form-control']) !!}
                    </div>

                    <div class="md-form margin-top-20">
                        {!! Form::label('password_confirm','Confirmación de contraseña (*)') !!}
                        {!! Form::password('password_confirm',['id'=>'password_confirm','class'=>'form-control']) !!}
                    </div>

                    <div class="md-form margin-top-10">
                        <a href="#!" class="btn-submit btn btn-block btn-success margin-top-5" id="btn-create-password">Guardar</a>
                    </div>
                    {!! Form::hidden('id',$user->id) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('js/usuario/create_password.js')}}"></script>
@endpush