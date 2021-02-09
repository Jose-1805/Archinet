<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/usuarios/crear.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal">Editar usuario</p>
            <p class="obligatorio margin-bottom-20">Los campos marcados con (*) son obligatorios</p>
            <div class="col-12 usuarios">
                <?php echo $__env->make('layouts.alertas',['id_contenedor'=>'alertas-editar-usuario'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-12 no-padding">
                <?php ($usuario->rol = $usuario->roles()->first()->id); ?>
                <?php echo Form::model($usuario,['id'=>'form-usuario']); ?>

                    <?php echo Form::hidden('usuario',$usuario->id,['id'=>'usuario']); ?>

                    <?php echo $__env->make('usuario.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::close(); ?>

            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

    <script src="<?php echo e(asset('js/usuario/editar.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>