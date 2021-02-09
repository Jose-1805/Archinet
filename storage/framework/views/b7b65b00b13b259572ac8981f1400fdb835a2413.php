
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/usuarios/index.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Historia Laboral</p>
            <?php if(session('msg')): ?>
                <div class="md_import alert alert-warning alert-dismissible fade show" style="width: 100%" role="alert">
                    <h3 class="alert-heading">Información</h3>
                    <hr>
                    <p class="informacion" ><?php echo session('msg'); ?></p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
           <div class="botones_derecha ">
               <form action="<?php echo e(url('/expediente/import')); ?>" method="POST" style="display: inline-block" id="frmImportar" enctype="multipart/form-data">
                   <?php echo e(csrf_field()); ?>

                   <input type="file" name="excel" style="display: none;" id="inputFile" accept=".xls, .xlsx, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                   <button class="btn-exportar btn btn-default btn-submit" id="importar_funcionarios" data-toggle="tooltip" data-placement="bottom" title="Sólo se permiten archivos de tipo excel">Importar Funcionarios</button>
               </form>

                <?php if(Auth::user()->tieneFuncion($identificador_modulo, 'crear', $privilegio_superadministrador)): ?>
                    <a href="<?php echo e(url('/expediente/crear')); ?>" class="btnExpediente btnCustom btn-primary " data-placement="right"
                       title="Nuevo expediente">CREAR EXPEDIENTE</a>
                <?php endif; ?>
           </div>
            <div class="col-12">
                <?php echo $__env->make('layouts.alertas',['id_contenedor'=>'alertas-usuario'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-12 no-padding">

                <table id="tabla-expediente" class="table table-striped table-bordered table-responsive-md">
                    <thead>

                    <th>Apellidos y nombres</th>
                    <th>Identificación</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Estado</th>


                    <?php if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones($identificador_modulo,['editar'],false,$privilegio_superadministrador)): ?>
                        <th class="text-center">Opciones</th>
                    <?php endif; ?>
                  </thead>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('DataTables-1.10.15/media/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('js/expediente/index.js')); ?>"></script>
    <script>
        var tiene_opciones = false;

        <?php if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones($identificador_modulo,['editar'],false,$privilegio_superadministrador)): ?>
            tiene_opciones = true;
        <?php endif; ?>

        $(function () {


            if (tiene_opciones) {
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'identificacion', name: 'identificacion'},
                    {data: 'email', name: 'email'},
                    {data: 'direccion', name: 'direccion'},
                    {data: 'estado', name: 'estado'},

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
                    {data: 'identificacion', name: 'identificacion'},
                    {data: 'email', name: 'email'},
                    {data: 'direccion', name: 'direccion'},
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
            cargarTablaFuncionarios();
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>