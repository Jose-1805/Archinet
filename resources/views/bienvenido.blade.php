@extends('layouts.app_guest')

@section('form')
    <div class="card">
        <div class="card-body z-depth-2">
            <!--Header-->
            <div class="">
                <h3 class="dark-grey-text">
                    <strong class="">Ingresar</strong>
                </h3>
                <div class="blue" style="">
                    <img class="right" src="{{asset('imagenes/logos/logoarchinet.png')}}" style="height: 50px;margin-top: -60px;" alt="Logo SENA"/>
                </div>
            </div>
            <hr>

            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="md-form">
                    <label for="email" class="control-label">Correo</label>

                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus placeholder="Escriba su correo">

                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="md-form">
                    <label for="password" class="control-label">Contraseña</label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Escriba su contraseña">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                    </label>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">
                        Ingresar
                    </button>
                </div>

                <div class="text-center">
                    <a class="" href="{{ route('password.request') }}">
                        ¿Ha olvidado su contraseña?
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('body')
    @if(Auth::guest())
        @include('bienvenido.modales')
    @endif
@endsection