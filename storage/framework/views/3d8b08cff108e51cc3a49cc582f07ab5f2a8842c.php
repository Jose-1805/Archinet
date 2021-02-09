<p>Se ha registrado el documento <strong><?php echo e($documento->tipoDocumental->nombre); ?> (<?php echo e($documento->descripcion); ?>)</strong> en el sistema web de <a href="<?php echo e(url('/')); ?>"><?php echo e(config('app.name', 'Archinet')); ?></a>.</p>

<p>Este documento no ha sido validado, lo cual no le permitirá generar certificados en el sistema. Para validar el documento dirijase a la oficina de relaciones laborales en el Sena Centro de Comercio y Servicios para presentar el documento original y proceder realizar la respectiva validación</p>
