<div class="contenedor col-md-10 mx-auto ">
    <div class="inicio col-md-12 text-center">
        <div class="slider col-md-8">
            <img   src="{{asset('imagenes/bienvenido/slider.jpg')}}" alt="Slider del prototipo" style="width: 100%;height: auto;"/>
        </div>
        <div class="iniciosesion col-md-4">
            <div class="row" style="">
                <div >
                    {{--<a class="btn btn-success" data-toggle="modal" data-target="#modal-login">Iniciar Sesion</a>--}}
                    @include('layouts.alertas',["id_contenedor"=>"alertas-login"])

                    <form class=" frmLogin form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="md-form">
                            <label for="email" class="control-label">Correo</label>

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block text-danger">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="md-form">
                            <label for="password" class="control-label">Contraseña</label>
                            <input id="password" type="password" class="form-control" name="password" required>
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

        </div>
    </div>
    <div class="contenido">
        <div class="contenido1 col-5">
            <p>¿Qué es Lorem Ipsum?
                Lorem Ipsum es simplemente
                el texto de relleno de las imprentas
                y archivos de texto. Lorem Ipsum ha sido
                el texto de relleno estándar de las industrias
                desde el año 1500, cuando un impresor (N. del T.
                persona que se dedica a la imprenta) desconocido
                usó una galería de textos y los mezcló de tal
                manera que logró hacer un libro de textos especimen.
                No sólo sobrevivió 500 años, sino que tambien ingresó
                como texto de relleno en documentos electrónicos, quedando
                esencialmente igual al original. Fue popularizado
                en los 60s con la creación de las hojas "Letraset",
                las cuales contenian pasajes de Lorem Ipsum, y más
                recientemente con software de autoedición, como por
                ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>
        </div>
        <div class="contenido2 col-5">
            <p>¿Qué es Lorem Ipsum?
                Lorem Ipsum es simplemente
                el texto de relleno de las imprentas
                y archivos de texto. Lorem Ipsum ha sido
                el texto de relleno estándar de las industrias
                desde el año 1500, cuando un impresor (N. del T.
                persona que se dedica a la imprenta) desconocido
                usó una galería de textos y los mezcló de tal
                manera que logró hacer un libro de textos especimen.
                No sólo sobrevivió 500 años, sino que tambien ingresó
                como texto de relleno en documentos electrónicos, quedando
                esencialmente igual al original. Fue popularizado
                en los 60s con la creación de las hojas "Letraset",
                las cuales contenian pasajes de Lorem Ipsum, y más
                recientemente con software de autoedición, como por
                ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>
        </div>
    </div>
</div>