@extends('layouts.app_guest')

@section('form')
    <div class="card">
        <div class="card-body">
            <div class="">
                <h4 class="dark-grey-text">
                    <strong class="">Restablecer contraseña</strong>
                </h4>
            </div>
            <hr>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Correo electrónico</label>

                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Escriba su correo electrónico">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="md-form">
                    <div class="col-12 text-center no-padding margin-top-20">
                        <button type="submit" class="btn btn-success btn-block">
                            Solicitar restablecimiento
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection