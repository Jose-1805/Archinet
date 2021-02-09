

<?php $__env->startSection('content'); ?>
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Tipos documentales</p>

            <div class="col-12 no-padding">
                <?php if(Auth::user()->tieneFuncion($identificador_modulo, 'crear', $privilegio_superadministrador)): ?>
                    <a href="#!" class="btn btn-primary right" data-toggle="modal" data-target="#modal-crear-tipo-documental">CREAR TIPO DOCUMENTAL</a>
                <?php endif; ?>
            </div>
            
            
            
            
            

            <div class="col-12">
                <?php echo $__env->make('layouts.alertas',['id_contenedor'=>'alertas-tipo-documental'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-12 no-padding">
                <table id="tabla-tipos-documentales" class="table table-striped table-bordered table-responsive-md">
                    <thead>
                    <th>Nombre</th>
                    <th>Sección</th>
                    <?php if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones($identificador_modulo,['editar'],false,$privilegio_superadministrador)): ?>
                        <th class="text-center">Editar</th>
                    <?php endif; ?>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-crear-tipo-documental" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Ingrese los datos del tipo documental</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <?php echo $__env->make('tipo_documental.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Regresar</button>
                    <button type="button" class="btn btn-primary" id="btn-guardar-nuevo-tipo-documental">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-editar-tipo-documental" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Actualice los datos del tipo documental</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Regresar</button>
                    <button type="button" class="btn btn-primary" id="btn-actualizar-tipo-documental">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-confirmar-tipo-documental" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Confirmar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de actualizar el tipo documental?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn-actualizar-tipo-documental-no">No</button>
                    <button type="button" class="btn btn-primary" id="btn-actualizar-tipo-documental-ok">Si</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('DataTables-1.10.15/media/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('js/tipo_documental/index.js')); ?>"></script>
    <script>
   
        var tiene_opciones = false;

        <?php if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones($identificador_modulo,['editar','eliminar'],false,$privilegio_superadministrador)): ?>
            tiene_opciones = true;
        <?php endif; ?>

        $(function () {

            if (tiene_opciones) {
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'seccion', name: 'seccion'},
                    {data: 'editar', name: 'editar', orderable: false, searchable: false, "className": "text-center"}
                ];
            } else {
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'seccion', name: 'seccion'}
                ]
            }
            setCols(cols);
            cargarTablaTiposDocumentales();
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>