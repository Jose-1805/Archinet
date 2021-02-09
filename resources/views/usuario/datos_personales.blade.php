<div class="row">
    <div class="col-12 col-md-12 col-lg-12 no-padding" id="datos_personales_usuario">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <div class="md-form c-select">
                    {!! Form::label('tipo_identificacion','Tipo de identificación (*)',['class'=>'active']) !!}
                    {!! Form::select('tipo_identificacion',['Seleccione','cédula de ciudadanía'=>'cédula de ciudadanía','cédula de extranjería'=>'cédula de extranjería'],null,['id'=>'tipo_identificacion','class'=>'form-control']) !!}
                </div>
            </div>

            <div class="col-md-4 col-lg-4">
                <div class="md-form">
                    {!! Form::label('identificacion','No. de identificación (*)') !!}
                    {!! Form::text('identificacion',null,['id'=>'identificacion','class'=>'form-control num-int-positivo numeric valid-restrict-field no-paste required_field valid_lenght','data-required'=>'Debe escribir un número de identificación','data-field'=>'identificación','data-min-length'=>7,'maxlength'=>'10']) !!}
                    <p class="count-length">15</p>
                </div>
            </div>

            <div class="col-md-4 col-lg-4">
                <div class="md-form">
                    {!! Form::label('nombres','Nombres (*)',['class'=>'control-label']) !!}
                    {!! Form::text('nombres',null,['id'=>'nombres','class'=>'form-control valid_lenght alphabetical_space valid-restrict-field no-paste required_field','data-required'=>'Debe escribir un nombre','data-field'=>'nombre','data-min-length'=>3,'maxlength'=>45,'pattern'=>'^[A-z ñ]{1,}$','data-error'=>'Ingrese únicamente letras']) !!}
                    <p class="count-length">45</p>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="md-form">
                    {!! Form::label('apellidos','Apellidos (*)',['class'=>'control-label']) !!}
                    {!! Form::text('apellidos',null,['id'=>'apellidos','class'=>'form-control alphabetical_space valid-restrict-field no-paste required_field valid_lenght','data-required'=>'Debe escribir un apellido','data-field'=>'nombre','data-min-length'=>3,'maxlength'=>45,'pattern'=>'^[A-z ñ]{1,}$','data-error'=>'Ingrese únicamente letras']) !!}
                    <p class="count-length">45</p>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="md-form">
                    {!! Form::label('email','Correo (*)',['class'=>'control-label']) !!}
                    {!! Form::text('email',null,['id'=>'email','class'=>'form-control valid-restrict-field no-paste mail required_field','data-required'=>'Debe escribir un correo','maxlength'=>150,'pattern'=>'^[A-z0-9@.-]{1,}$','data-error'=>'Caracteres no válidos']) !!}
                    <p class="count-length">150</p>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="md-form">
                    {!! Form::label('celular','Teléfono (*)') !!}
                    {!! Form::text('celular',null,['id'=>'celular','class'=>'form-control num-int-positivo numeric valid-restrict-field no-paste required_field valid_lenght','data-required'=>'Debe escribir un número telefonico','data-field'=>'','data-min-length'=>10,'maxlength'=>'10']) !!}
                    <p class="count-length">10</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 m">
                <div class="md-form" id="contenedor_fecha_inicio">
                    {!! Form::label('fecha_inicio_contrato','Fecha inicio de contrato (*)',['class'=>'active']) !!}
                    {!! Form::date('fecha_inicio_contrato',null,['id'=>'fecha_inicio_contrato','class'=>'form-control required_field','data-required'=>'Debe escribir una fecha']) !!}
                </div>
            </div>

            <div class="col-md-6 col-lg-4 m">
                <div class="md-form" id="contenedor_fecha_terminacion">
                    {!! Form::label('fecha_terminacion_contrato','Fecha fin de contrato (*)',['class'=>'active']) !!}
                    {!! Form::date('fecha_terminacion_contrato',null,['id'=>'fecha_terminacion_contrato','class'=>'form-control required_field','data-required'=>'Debe escribir una fecha']) !!}
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="md-form c-select">
                    {!! Form::label('rol','Rol (*)',['class'=>'active']) !!}
                    {!! Form::select('rol',[''=>'Seleccione']+\Archinet\Models\Rol::permitidos()->where('roles.funcionario','no')->where('roles.superadministrador','no')->pluck('nombre','id')->toArray(),$usuario->rol_id,['id'=>'rol','class'=>'form-control']) !!}
                </div>
            </div>

            <div class="col-md-6 col-lg-4 m">
                <div class="md-form c-select">
                    {!! Form::label('estado','Estado (*)',['class'=>'active']) !!}
                    {!! Form::select('estado',[''=>'Seleccione', 'activo'=>'Activo','inactivo'=>'Inactivo'],null,['id'=>'estado','class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
