<div class="encabezado-verde" ></div>
<header class="header-principal">
    <div class="header-logo-sena col-sm-3 ">
        <img src="<?php echo e(asset('imagenes/logos/logo.jpg')); ?>" alt="Logo SENA"/>
        <div class="header-division"></div> 
    </div>
    <h1 class="header-titulo col-sm-6">PROTOTIPO PARA LA GESTION  DE HISTORIA LABORAL</h1>
    <div class="header-logo-archi col-sm-2">                
        <img  src="<?php echo e(asset('imagenes/logos/logoarchinet.png')); ?>" alt="Logo Archinet"/>
    </div>

    <?php if(\Illuminate\Support\Facades\Auth::guest()): ?>
    
    <?php else: ?>
    <?php echo $__env->make('layouts.menus.autenticado', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
</header>


