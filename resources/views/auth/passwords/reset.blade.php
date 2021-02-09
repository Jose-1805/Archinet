@extends('layouts.app_guest')

@section('form')
    <div class="card">
        <div class="card-body">

            <div class="">
                <h3 class="dark-grey-text">
                    <strong class="">Restablecer contraseña</strong>
                </h3>
            </div>
            <hr>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form id="form_reset_password" class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Correo electrónico</label>

                    <input id="email" type="email" class="form-control valid-restrict-field no-paste mail required_field" data-required="Introduzca una dirección de correo electrónico" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="Escriba su correo">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Contraseña</label>

                    <input id="password" type="password" class="form-control valid-restrict-field no-paste valid_lenght required_field" data-field="contraseña" data-min-length="8" maxlength="30" data-required="Debe escribir una contraseña" name="password" required placeholder="Escriba su contraseña">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="md-form{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="control-label">Confirmación de contraseña</label>
                    <input id="password-confirm" type="password" class="form-control valid-restrict-field no-paste valid_lenght required_field" data-field="confirmación de contraseña" data-min-length="8" maxlength="30" data-required="Por favor confirme su contraseña" name="password_confirmation" required placeholder="Vuelva a escribir su contraseña">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="md-form">
                    <div class="col-12 text-center no-padding margin-top-20">
                        <button type="submit" class="btn btn-success btn-block">
                            Aceptar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection