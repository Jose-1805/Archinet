<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/rol/index.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
        <div class="container-fluid white padding-50">
            <div class="row">
                <p class="titulo_principal margin-bottom-20">Roles</p>
                <div class="contenedor-opciones-vista-fixed">
                </div>
                <div class="col-12 no-padding text-right">
                    <?php if(Auth::user()->tieneFuncion($identificador_modulo, 'crear', $privilegio_superadministrador)): ?>
                        <a id="btn_modal_nuevo_rol" href="#!" class=" btnCrear  btn btn-primary right" title="Nuevo Rol"
                           style="">Crear rol</a>
                    <?php endif; ?>
                </div>
                <div class="col-sm-12 no-padding" style="min-height: 100px;" id="contenedor-roles">
                </div>

                <div class=" modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="mdlDetalles modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle" 
                            style="color:#000000;">Detalles</h5>
                            
                            
                            
                        </div>
                        <div class="modal-body">

                            <div style="min-height: 100px;" id="contenedor-privilegios">
                                <?php echo $__env->make('rol.lista_privilegios', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btnAceptar btn-success btn" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    <?php echo $__env->make('rol.modales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('DataTables-1.10.15/media/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('js/rol/roles.js')); ?>"></script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>