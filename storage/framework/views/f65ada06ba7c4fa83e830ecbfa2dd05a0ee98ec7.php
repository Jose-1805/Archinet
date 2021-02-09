<?php 
    $tipo_documental = $documento->tipoDocumental;
    $metadatos = $documento->metadatos;
 ?>
<div class="row">
    <div class="col-12 margin-bottom-20">
        <h5 class="mayuscula"><?php echo e($tipo_documental->nombre); ?></h5>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="md-form">
            <?php echo Form::label('cantidad_folios','Cantidad de folios', ['class'=>'active']); ?>

            <?php echo Form::text('cantidad_folios',$documento->cantidad_folios,['id'=>'cantidad_folios','class'=>'form-control', 'disabled']); ?>

        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="md-form">
            <?php echo Form::label('fecha_documento','Fecha del documento', ['class'=>'active']); ?>

            <?php echo Form::date('fecha_documento',$documento->fecha_documento,['id'=>'fecha_documento','class'=>'form-control', 'disabled']); ?>

        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="md-form">
            <?php echo Form::label('descripcion','Descripción', ['class'=>'active']); ?>

            <?php echo Form::text('descripcion',$documento->descripcion,['id'=>'descripcion','class'=>'form-control', 'disabled']); ?>

        </div>
    </div>

    <div class="col-12">
        <div class="md-form">
            <?php echo Form::label('observaciones','Observaciones', ['class'=>'active']); ?>

            <?php echo Form::text('observaciones',$documento->observaciones,['id'=>'observaciones','class'=>'form-control', 'disabled']); ?>

        </div>
    </div>

    <?php ($view = 'expediente.documentos.secciones.'.$tipo_documental->seccion->nombre_carpeta.'.'.$tipo_documental->carpeta.'.datos_form'); ?>

    <?php if(\Illuminate\Support\Facades\View::exists($view)): ?>
        <?php echo Form::model($metadatos, ['id'=>'form-metadatos','class'=>'col-12']); ?>

            <div class="row">
                <?php echo $__env->make($view,['editable'=>false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        <?php echo Form::close(); ?>

    <?php endif; ?>

    <div class="col-12 col-sm-6 margin-top-20">
        <a class="btn btn-block btn-default" data-dismiss="modal">Regresar</a>
    </div>

    <div class="col-12  col-sm-6 margin-top-20">
        <a class="btn btn-block btn-primary" target="_blank" href="<?php echo e(url('/expediente/ver-documento/'.$documento->id)); ?>">Ver documento <i class="fas fa-file-pdf font-medium margin-left-10"></i></a>
    </div>
</div>

<?php if($tipo_documental->carpeta == 'certificados_estudio_diplomas'): ?>
    <script>
        $(function () {
            $('#tipo').change();
            <?php if($metadatos->graduado == 'si'): ?>
                $('#graduado_si').change();
            <?php endif; ?>
            $('#contenedor_tipo').removeClass('d-none');
        })
    </script>
<?php endif; ?>

<?php if($tipo_documental->carpeta == 'certificaciones_laborales'): ?>
    <script>
        $(function () {
            $('#tipo').change();
            $('#contenedor_tipo_empresa').removeClass('d-none');
        })
    </script>
<?php endif; ?>


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