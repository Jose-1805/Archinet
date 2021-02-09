@php
    $tipo_documental = $documento->tipoDocumental;
    $metadatos = $documento->metadatos;
@endphp
{!! Form::model($documento,['id'=>'form-editar-documento']) !!}
    {!! Form::hidden('documento',$documento->id) !!}
    @include('expediente.documentos.secciones.datos_form_tipo_documental',['tipo_documental'=>$tipo_documental,'documento'=>$documento])
{!! Form::close() !!}

@if ($tipo_documental->carpeta == 'certificados_estudio_diplomas')
    <script>
        $(function () {
            $('#tipo').change();
            @if($metadatos->graduado == 'si')
                $('#graduado_si').change();
            @endif
        })
    </script>
@endif

@if ($tipo_documental->carpeta == 'certificaciones_laborales')
    <script>
        $(function () {
            $('#tipo').change();
        })
    </script>
@endif

<script>
    $(function () {
        $('#modal-editar-documento').find('#cantidad_folios').prop('disabled',true);
        @if(!Auth::user()->esSuperadministrador())
            $('#contenedor-upload').remove();
        @endif
    })
</script>