<?php
if (!isset($usuario)) $usuario = new \Archinet\User();
?>
<?php echo Form::model($usuario,['id'=>'form-expediente','data-toggle'=>'validator']); ?>


<?php echo $__env->make('layouts.alertas',['id_contenedor'=>'alertas-usuario'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<div class="col-12">
    <?php echo $__env->make('expediente.datos_personales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>

<?php if(!$usuario->exists): ?>

<?php endif; ?>
<div class="botones">
    <a href="<?php echo e(url('/expediente')); ?>" class="btn-guardar btn btn-default btn-submit" id="">Regresar</a>
    <a href="#!" class="btn-expediente btn btn-success btn-submit" id="btn-guardar-expediente">Guardar</a>
</div>
<?php echo Form::close(); ?>

