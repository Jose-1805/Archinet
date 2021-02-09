@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Inicio de sesión</div>
                <div class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="md-form">
                            <label for="email" class="control-label active">Correo</label>

                            <div class="">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus placeholder="Introduce tu correo">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="md-form">
                            <label for="password" class="control-label active">Contraseña</label>

                            <div class="">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Introduce tu contraseña">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="md-form">
                            <div class="">
                                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                            </div>
                        </div>

                        <div class="md-form">
                            <div class="">
                                <button type="submit" class="btn btn-success">
                                    Ingresar
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Ha olvidado su contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
