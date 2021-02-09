<p><?php echo e($descripcion); ?></p>
<br>
<p>Datos del funcionario</p>
<p><strong>Nombre: </strong><?php echo e(Auth::user()->fullName()); ?></p>
<p><strong><?php echo e(Auth::user()->tipo_identificacion); ?>: </strong><?php echo e(Auth::user()->identificacion); ?></p>
<p><strong>Correo: </strong><?php echo e(Auth::user()->email); ?></p>
