<?php
    if (!isset($tipo_documental)) $tipo_documental = new \Archinet\Models\TipoDocumental();
    if (!isset($id_form)) $id_form = 'form-nuevo-tipo-documental';
?>

@php($secciones = [''=>'Seleccione']+\Archinet\Models\Seccion::orderBy('nombre')->pluck('nombre','id')->toArray())

{!! Form::model($tipo_documental,['id'=>$id_form]) !!}
    @if($tipo_documental->exists)
        {!! Form::hidden('id',$tipo_documental->id) !!}
    @endif

    <div class="md-form">
        {!! Form::label('nombre','Nombre *') !!}
        {!! Form::text('nombre',null,['id'=>'nombre','class'=>'form-control valid-restrict-field valid_lenght alphabetical_space no-paste required_field','data-required'=>'Debe escribir un nombre','data-field'=>'nombre','data-min-length'=>4,'maxlength'=>150]) !!}
    </div>

    <div class="md-form margin-top-20">
        {!! Form::label('seccion','Sección *') !!}
        {!! Form::select('seccion',$secciones,null,['id'=>'seccion','class'=>'form-control valid-restrict-field required_field valid_select','data-required'=>'Debe seleccionar una sección para el tipo documental']) !!}
    </div>
{!! Form::close() !!}
