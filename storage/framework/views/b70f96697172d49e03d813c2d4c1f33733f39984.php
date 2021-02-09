<?php 
    $tipo_documental = $documento->tipoDocumental;
    $metadatos = $documento->metadatos;
 ?>
<?php echo Form::model($documento,['id'=>'form-editar-documento']); ?>

    <?php echo Form::hidden('documento',$documento->id); ?>

    <?php echo $__env->make('expediente.documentos.secciones.datos_form_tipo_documental',['tipo_documental'=>$tipo_documental,'documento'=>$documento], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::close(); ?>


<?php if($tipo_documental->carpeta == 'certificados_estudio_diplomas'): ?>
    <script>
        $(function () {
            $('#tipo').change();
            <?php if($metadatos->graduado == 'si'): ?>
                $('#graduado_si').change();
            <?php endif; ?>
        })
    </script>
<?php endif; ?>

<?php if($tipo_documental->carpeta == 'certificaciones_laborales'): ?>
    <script>
        $(function () {
            $('#tipo').change();
        })
    </script>
<?php endif; ?>

<script>
    $(function () {
        $('#modal-editar-documento').find('#cantidad_folios').prop('disabled',true);
        <?php if(!Auth::user()->esSuperadministrador()): ?>
            $('#contenedor-upload').remove();
        <?php endif; ?>
    })
</script>