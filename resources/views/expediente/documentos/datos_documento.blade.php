@php
    $tipo_documental = $documento->tipoDocumental;
    $metadatos = $documento->metadatos;
@endphp
<div class="row">
    <div class="col-12 margin-bottom-20">
        <h5 class="mayuscula">{{$tipo_documental->nombre}}</h5>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="md-form">
            {!! Form::label('cantidad_folios','Cantidad de folios', ['class'=>'active']) !!}
            {!! Form::text('cantidad_folios',$documento->cantidad_folios,['id'=>'cantidad_folios','class'=>'form-control', 'disabled']) !!}
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="md-form">
            {!! Form::label('fecha_documento','Fecha del documento', ['class'=>'active']) !!}
            {!! Form::date('fecha_documento',$documento->fecha_documento,['id'=>'fecha_documento','class'=>'form-control', 'disabled']) !!}
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="md-form">
            {!! Form::label('descripcion','Descripción', ['class'=>'active']) !!}
            {!! Form::text('descripcion',$documento->descripcion,['id'=>'descripcion','class'=>'form-control', 'disabled']) !!}
        </div>
    </div>

    <div class="col-12">
        <div class="md-form">
            {!! Form::label('observaciones','Observaciones', ['class'=>'active']) !!}
            {!! Form::text('observaciones',$documento->observaciones,['id'=>'observaciones','class'=>'form-control', 'disabled']) !!}
        </div>
    </div>

    @php($view = 'expediente.documentos.secciones.'.$tipo_documental->seccion->nombre_carpeta.'.'.$tipo_documental->carpeta.'.datos_form')

    @if(\Illuminate\Support\Facades\View::exists($view))
        {!! Form::model($metadatos, ['id'=>'form-metadatos','class'=>'col-12']) !!}
            <div class="row">
                @include($view,['editable'=>false])
            </div>
        {!! Form::close() !!}
    @endif

    <div class="col-12 col-sm-6 margin-top-20">
        <a class="btn btn-block btn-default" data-dismiss="modal">Regresar</a>
    </div>

    <div class="col-12  col-sm-6 margin-top-20">
        <a class="btn btn-block btn-primary" target="_blank" href="{{url('/expediente/ver-documento/'.$documento->id)}}">Ver documento <i class="fas fa-file-pdf font-medium margin-left-10"></i></a>
    </div>
</div>

@if ($tipo_documental->carpeta == 'certificados_estudio_diplomas')
    <script>
        $(function () {
            $('#tipo').change();
            @if($metadatos->graduado == 'si')
                $('#graduado_si').change();
            @endif
            $('#contenedor_tipo').removeClass('d-none');
        })
    </script>
@endif

@if ($tipo_documental->carpeta == 'certificaciones_laborales')
    <script>
        $(function () {
            $('#tipo').change();
            $('#contenedor_tipo_empresa').removeClass('d-none');
        })
    </script>
@endif


<script>
    $(function () {
        $('#form-metadatos *').prop('disabled', true);
        //se quita el seleccione de los select que no tengan valor
        $('#form-metadatos select').each(function (i,el) {
            if(!$(el).val()){
                $(el).children('option').eq(0).html('');
            }
        })
    })
</script>