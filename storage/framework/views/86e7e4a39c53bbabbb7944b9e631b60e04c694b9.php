<div class="card">
    <!-- Default panel contents -->
    <div class="tablaroles ">
        <!-- Within <head></head> tags -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
        <table id="tabla_roles" class="table table-striped table-bordered table-responsive-sm" cellspacing="0" width="100%">
            <thead >

                <tr>
                    <th>Nombres</th>
                    <th class="text-center" id="th_principal">Opciones</th>
                    <th class="text-center th_remove" >Eliminar</th>
                    <th class="text-center th_remove">Detalles</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="permisos">

                    <td><?php echo e($rol->nombre); ?></td>
                    <td class="text-center td-peque" >
                        <?php if(Auth::user()->tieneFuncion($identificador_modulo,'editar',$privilegio_superadministrador)): ?>
                            <span class="fa fa-edit btn-editar-rol cursor_pointer blue-text" data-rol="<?php echo e($rol->id); ?>" title="Editar"></span>
                        <?php endif; ?>

                    </td>
                    <td class="text-center td-peque">
                        <?php if(Auth::user()->tieneFuncion($identificador_modulo,'eliminar',$privilegio_superadministrador)): ?>
                        <span class="fa fa-trash btn-eliminar-rol cursor_pointer red-text" data-rol="<?php echo e($rol->id); ?>" title="Eliminar"></span>
                        <?php endif; ?>

                    </td>
                    <td class="text-center td-peque"><span class="fa fa-angle-right btn-privilegios-rol cursor_pointer green-text font-large"  data-rol="<?php echo e($rol->id); ?>" data-toggle="modal" title="Ver detalles" data-target="#exampleModalCenter"></span>
                    </td>
                </tr>
            </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li class="list-group-item">No existen roles registrados.</li>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?php echo e(asset('/js/rol/tablas.js')); ?>"></script>