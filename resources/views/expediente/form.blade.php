<?php
if (!isset($usuario)) $usuario = new \Archinet\User();
?>
{!! Form::model($usuario,['id'=>'form-expediente','data-toggle'=>'validator']) !!}

@include('layouts.alertas',['id_contenedor'=>'alertas-usuario'])

{{--<p class="titulo_principal margin-bottom-20 margin-top-20 col-12">Datos personales</p>--}}
<div class="col-12">
    @include('expediente.datos_personales')
</div>

@if(!$usuario->exists)

@endif
<div class="botones">
    <a href="{{url('/expediente')}}" class="btn-guardar btn btn-default btn-submit" id="">Regresar</a>
    <a href="#!" class="btn-expediente btn btn-success btn-submit" id="btn-guardar-expediente">Guardar</a>
</div>
{!! Form::close() !!}
