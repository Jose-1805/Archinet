
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/usuarios/index.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Usuarios</p>

            <div class="conten_crear">
                <?php if(Auth::user()->tieneFuncion($identificador_modulo, 'crear', $privilegio_superadministrador)): ?>
                    <a href="<?php echo e(url('/usuario/crear')); ?>" class="btnCrearUsuario btn-primary " data-placement="right"
                       title="Nuevo usuario">CREAR USUARIO</a>
                <?php endif; ?>
            </div>
            
            
            
            
            

            <div class="col-12">
                <?php echo $__env->make('layouts.alertas',['id_contenedor'=>'alertas-usuario'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-12 no-padding">
                <table id="tabla-usuarios" class="table table-striped table-bordered table-responsive-md">
                    <thead>

                    <th>Apellidos y nombres</th>
                    <th>Celular</th>
                    <th>Correo</th>                   
                    
                    <th>Fecha Inicio Contrato</th>
                    <th>Fecha Fin Contrato</th>
                    <th>Estado</th>
                    <th>Rol</th>
                    <?php if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones($identificador_modulo,['editar'],false,$privilegio_superadministrador)): ?>
                        <th class="text-center">Opciones</th>
                    <?php endif; ?>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-desactivar-usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Desactivar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Desactivar un usuario bloqueará todas las funcionalidades habilitadas para él.</p>
                    <p>¿Está seguro de desactivar al usuario seleccionado?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger btn-submit" id="btn-desactivar">Si</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-activar-usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Activar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Activar un usuario activará todas las funcionalidades relacionadas a él</p>
                    <p>¿Está seguro de activar al usuario seleccionado?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary btn-submit" id="btn-activar">Si</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('DataTables-1.10.15/media/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('js/usuario/index.js')); ?>"></script>
    <script>
   
        var tiene_opciones = false;

        <?php if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones($identificador_modulo,['editar'],false,$privilegio_superadministrador)): ?>
            tiene_opciones = true;
        <?php endif; ?>

        $(function () {

            if (tiene_opciones) {
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'celular', name: 'celular'},
                    {data: 'email', name: 'email'},
                    {data: 'fecha_inicio_contrato', name: 'fecha_inicio_contrato'},
                    {data: 'fecha_terminacion_contrato', name: 'fecha_inicio_contrato'},
                    {data: 'estado', name: 'estado'},
                    {data: 'rol', name: 'rol'},
                    {
                        data: 'opciones',
                        name: 'opciones',
                        orderable: false,
                        searchable: false,
                        "className": "text-center"
                    }
                ];
            } else {
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'celular', name: 'celular'},
                    {data: 'email', name: 'email'},
                    {data: 'fecha_inicio_contrato', name: 'fecha_inicio_contrato'},
                    {data: 'fecha_terminacion_contrato', name: 'fecha_inicio_contrato'},
                    {data: 'estado', name: 'estado'},
                    {data: 'rol', name: 'rol'},
                    {
                        data: 'opciones',
                        name: 'opciones',
                        orderable: false,
                        searchable: false,
                        "className": "text-center"
                    }
                ]
            }
            setCols(cols);
            cargarTablaUsuarios();
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>