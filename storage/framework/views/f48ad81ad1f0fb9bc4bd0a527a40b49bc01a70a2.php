<div class="">
    <!-- Default panel contents -->

    <div class="row">
    
    <div class="rol"> El rol: <?php echo e(isset($rol) ? ' '.$rol->nombre:''); ?></div>

    </div>
    
    <!-- List group -->
   
    <div class="list-group lista">
        <p class="permiso rol">Tiene asignado los siguientes permisos</p>
        <div class="row texto1">
            <div class="col-md-6 texto">Modulos</div>
                    <div class="col-md-6 texto">Permisos</div>
                    </div>
        <?php if(isset($rol)): ?>
            <?php if($rol->privilegios): ?>

                <?php $__currentLoopData = $rol->dataPrivilegios(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $funciones = '';
                        for($i = 0; $i < count($pr['funciones']);$i++){
                            $funciones .= $pr['funciones'][$i].', ';
                        }
                        $funciones = trim($funciones);
                        $funciones = trim($funciones,',');
                    ?>            
                    <div class="row mod-funciones">
                    <div class="fun col-md-6"><?php echo e($pr['nombre']); ?></div>
                    <div class="fun col-md-6"><?php echo e('('.$funciones.')'); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <li class="list-group-item">Rol sin privilegios asociados</li>
            <?php endif; ?>
        <?php else: ?>
            <li class="list-group-item">Lista de privilegios asociados a un rol</li>
        <?php endif; ?>
    </div>
</div>
