<?php $__env->startSection('css'); ?>
    ##parent-placeholder-2f84417a9e73cead4d5c99e05daff2a534b30132##

    <link href="<?php echo e(asset('css/configuracion.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Configuraciones</p>

            <div class="col-12 no-padding">
                <?php echo $__env->make('layouts.alertas',['id_contenedor'=>'alertas-configuraciones'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <a class="opcion-configuracion border hoverable col-6 col-sm-4 col-md-3 col-lg-2" href="#!" data-toggle="modal" data-target="#modal-contrasena">
                <div class="col-xs-12 text-center padding-bottom-10 padding-top-10">
                    <i class="fa fa-unlock-alt fa-3x" style="padding-bottom: 4px;"></i>
                </div>
                <p class="text-center col-xs-12 truncate no-padding">Contraseña</p>
            </a>

            <?php if(Auth::user()->tieneFuncion(\Archinet\Http\Controllers\TipoDocumentalController::$IDENTIFICADOR_MODULO,'ver',\Archinet\Http\Controllers\TipoDocumentalController::$PRIVILEGIO_SUPERADMINISTRADOR)): ?>
                <a class="opcion-configuracion border hoverable col-6 col-sm-4 col-md-3 col-lg-2" href="<?php echo e(url('/tipo-documental')); ?>">
                    <div class="col-xs-12 text-center padding-bottom-10 padding-top-10">
                        <i class="fas fa-folder-plus fa-3x" style="padding-bottom: 4px;"></i>
                    </div>
                    <p class="text-center col-xs-12 truncate no-padding">Tipos documentales</p>
                </a>
            <?php endif; ?>


            <?php if(Auth::user()->esSuperadministrador()): ?>
                <a class="opcion-configuracion border hoverable col-6 col-sm-4 col-md-3 col-lg-2" href="#!" data-toggle="modal" data-target="#modal-correos">
                    <div class="col-xs-12 text-center padding-bottom-10 padding-top-10">
                        <i class="fa fa-envelope fa-3x" style="padding-bottom: 4px;"></i>
                    </div>
                    <p class="text-center col-xs-12 truncate no-padding">Correos</p>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php echo $__env->make('configuracion.modales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('js/configuracion/index.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>