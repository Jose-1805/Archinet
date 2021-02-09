<?php
if (!isset($rol)) $rol = new \Archinet\Models\Rol();
?>
<div class="row">
    <div class="col-12">
        <div class="md-form">
            <?php echo Form::label('nombre','Nombre',['class'=>'control-label active']); ?>

            <?php echo Form::text('nombre',$rol->nombre,['id'=>'nombre','class'=>'form-control alphabetical_space valid-restrict-field no-paste','placeholder'=>'Nombre del rol','maxlength'=>46]); ?>

            <?php if(!$rol->exists): ?>
                <p class="count-length">45</p>
            <?php else: ?>
                <p class="count-length"><?php echo e(45-strlen($rol->nombre)); ?></p>
            <?php endif; ?>
            <?php echo Form::hidden('rol',$rol->id,['id'=>'rol']); ?>

        </div>
    </div>

    <?php 
        $rol_funcionario = \Archinet\Models\Rol::funcionario();
        $disabled = '';
        $checked = '';
        if($rol_funcionario){
                $disabled = 'disabled="disabled"';
                if($rol->exists && ($rol->id == $rol_funcionario->id)){
                    $checked = 'checked="checked"';
                    $disabled = '';
                }
        }
     ?>

    <?php if(config('params.habilitar_roles_funcionarios')): ?>
        <div class="col-12">
            <label>
                <input type="checkbox" name="funcionario" id="check_funcionario" value="si" <?php echo e($disabled); ?> <?php echo e($checked); ?>>Selecione
                si es funcionario
                SENA
            </label>
        </div>
    <?php endif; ?>
    <div class="col-12">
        <p class="titulo-per padding-top-10">Seleccione los permisos que tendrá este rol</p>
        <table class="table tabla-permisos">
            <div class="row permisos">
                <div class="modulo col-md-6"><h3>Módulos del sistema</h3></div>
                <div class="tar text-center tipografia col-md-6"><h3>Permisos</h3></div>
            </div>
            <thead class="opcion">
            <th class="funciones"></th>
            <?php $__currentLoopData = \Archinet\Models\Funcion::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th class="text-center" width="80"><?php echo e($f->nombre); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </thead>
            <tbody>
            <?php
            $modulos = \Archinet\Models\Modulo::permitidos()->orderBy('nombre')->get();
            $funciones = \Archinet\Models\Funcion::get();
            ?>
            <?php $__currentLoopData = $modulos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($m->funciones()->count() && $m->estado == 'Activo'): ?>
                    <tr>
                        <td class="etiqueta-tabla "><?php echo e($m->etiqueta); ?></td>
                        <?php $__currentLoopData = $funciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="text-center">
                                <?php if($m->tieneFuncion($f->id) && $m->usuarioTieneFuncion($f->identificador)): ?>
                                    <input type="checkbox" name="privilegios[]"
                                           value="<?php echo e($m->identificador.','.$f->identificador); ?>"
                                           <?php if($rol->exists && $rol->tieneFuncion($m->identificador,$f->identificador)): ?> checked="checked" <?php endif; ?>>
                                <?php endif; ?>
                            </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
