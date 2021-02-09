<?php ($secciones = \Archinet\Models\Seccion::all()); ?>
<?php $__currentLoopData = $secciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seccion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12 col-md-4 text-center border border-light grey lighten-4">
        <a href="<?php echo e(url('/expediente/seccion/'.$seccion->nombre_carpeta.'/'.$user->id)); ?>" class="text-center waves-effect waves-light">
            <div><i class="fas fa-folder-open fa-4x" style="color: <?php echo e(config('params.colores')['verde']); ?>"></i></div>
            <p class="font-small margin-top-10"><?php echo e($seccion->nombre); ?></p>
        </a>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="col-12 no-padding">
    <a href="<?php echo e(url('/expediente/')); ?>" class="btn-guardar btn btn-default btn-submit right" id="">REGRESAR</a>
</div>