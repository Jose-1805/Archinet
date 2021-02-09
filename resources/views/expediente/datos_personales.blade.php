
<div class="row">
    <div class="col-12 col-md-12 col-lg-12 no-padding" id="datos_personales_usuario">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <div class="md-form c-select">
                    {!! Form::label('tipo_identificacion','Tipo de identificación',['class'=>'active']) !!}
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
                    {!! Form::text('apellidos',null,['id'=>'apellidos','class'=>'form-control alphabetical_space valid-restrict-field no-paste required_field valid_lenght','data-required'=>'Debe escribir un apellido','data-field'=>'apellido','data-min-length'=>3,'maxlength'=>45,'pattern'=>'^[A-z ñ]{1,}$','data-error'=>'Ingrese únicamente letras']) !!}
                    <p class="count-length">45</p>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="md-form">
                    {!! Form::label('email','Correo SENA (*)',['class'=>'control-label']) !!}
                    {!! Form::text('email',null,['id'=>'email','class'=>'form-control valid-restrict-field no-paste  required_field','data-required'=>'Debe escribir un correo SENA','maxlength'=>150,'pattern'=>'^[A-z0-9@.-]{1,}$','data-error'=>'Caracteres no válidos']) !!}
                    <p class="count-length">150</p>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="md-form">
                    {!! Form::label('email_opcional','Correo Opcional',['class'=>'control-label']) !!}
                    {!! Form::text('email_opcional',null,['id'=>'email_opcional','class'=>'form-control  no-paste mail ','maxlength'=>150,'pattern'=>'^[A-z0-9@.-]{1,}$','data-error'=>'Caracteres no válidos']) !!}
                    <p class="count-length">150</p>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="md-form">
                    {!! Form::label('telefono_opcional','Teléfono Fijo') !!}
                    {!! Form::text('telefono_opcional',null,['id'=>'telefono_opcional',
                    'class'=>'form-control num-int-positivo numeric valid-restrict-field no-paste  valid_lenght','data-field'=>'','data-min-length'=>7,'maxlength'=>'7']) !!}
                    <p class="count-length">7</p>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="md-form">
                    {!! Form::label('celular','Teléfono (*)') !!}
                    {!! Form::text('celular',null,['id'=>'celular','class'=>'form-control num-int-positivo numeric valid-restrict-field no-paste required_field valid_lenght','data-required'=>'Debe escribir un número telefónico','data-field'=>'','data-min-length'=>10,'maxlength'=>'10']) !!}
                    <p class="count-length">10</p>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 m">
                <div class="md-form" id="contenedor_fecha_nacimiento">
                    {!! Form::label('fecha_nacimiento','Fecha Nacimiento (*)',['class'=>'active']) !!}
                    {!! Form::date('fecha_nacimiento',null,['id'=>'fecha_nacimiento','class'=>'form-control required_field','data-required'=>'Debe escribir una fecha nacimiento', 'max'=>date('Y-m-d',strtotime('-18 years'))]) !!}
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="md-form">
                    {!! Form::label('direccion','Dirección (*)') !!}
                    {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control  no-paste required_field valid-restrict-field','data-required'=>'Debe escribir una Dirección','data-field'=>'']) !!}
                    {{--<p class="count-length"></p>--}}
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 m">
                <div class="md-form c-select">
                    <div class="md-form c-select">
                    {!! Form::label('estado_civil','Estado Civil(*)',['class'=>'active']) !!}
                    {!! Form::select('estado_civil',
                    ['Seleccione','soltero'=>'soltero(a)','casado'=>'casado(a)','viudo'=>'viudo(a)',
                    'separado'=>'separado(a)'],null,['id'=>'estado_civil','class'=>'form-control']) !!}
                </div>
                </div>
            </div> 

            <div class="col-md-6 col-lg-4 m">
                <div class="md-form c-select">
                    {!! Form::label('estado','Estado Funcionario(*)',['class'=>'active']) !!}
                    {!! Form::select('estado',['Seleccione','activo'=>'Activo','inactivo'=>'Inactivo'],null,['id'=>'estado','class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
