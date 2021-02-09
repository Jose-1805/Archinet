<?php $__env->startSection('content'); ?>
	<div class="margin-top-50 col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
		<?php ($privilegios = explode('_', \Archinet\Models\Rol::strPrivilegios(session('rol')->privilegios))); ?>
		<h1 class="margin-bottom-10">Bienvenido a Archinet</h1>
		<div class="grey lighten-4 padding-top-20 padding-bottom-20 padding-left-30 padding-right-20">
			<h5 class="grey-text">En este sistema usted podrá: </h5>
			<?php if(Auth::user()->esSuperadministrador()): ?>
				<ul class="no-padding margin-top-20" style="list-style: none;">
					<li class="grey-text">• Gestionar expedientes y funcionarios</li>
					<li class="grey-text">• Generar hoja de vida de un funcionario</li>
					<li class="grey-text">• Agregar folios a un expediente</li>
					<li class="grey-text">• Gestionar roles del sistema</li>
					<li class="grey-text">• Gestionar Usuarios</li>
					<li class="grey-text">• Agregar tipos documentales</li>
					<li class="grey-text">• Configurar correo para recibir solicitudes de certificados laborales</li>
					<li class="grey-text">• Visualizar historial de eventos de usuarios en el sistema</li>
				</ul>
			<?php else: ?>
				<ul class="no-padding margin-top-20" style="list-style: none;">
					<?php $__empty_1 = true; $__currentLoopData = $privilegios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
						<li class="grey-text">• <?php echo e($p); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
						<li class="grey-text">No existen funcionalidades disponibles</li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>