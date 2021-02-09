<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title><?php echo e(config('app.name', 'Archinet')); ?></title>

        <link href="<?php echo e(asset('css/helpers.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('MDB-Free/css/bootstrap.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('MDB-Free/css/mdb.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('css/paginaprincipal.css')); ?>" rel="stylesheet" type="text/css">
        <?php echo $__env->yieldPushContent('css'); ?>
        
    </head>
    <body>
        <div class="encabezado-verde" ></div>
        <header class="header-principal">
            <div class="header-logo-sena col-sm-3 ">
                <a href="/"> <img src="<?php echo e(asset('imagenes/logos/logo.jpg')); ?>" alt="Logo SENA"/></a>
                <div class="header-division"></div> 
            </div>
            <h1 class="header-titulo col-sm-6">PROTOTIPO PARA LA GESTIóN  DE HISTORIA LABORAL</h1>
            <div class="header-logo-archi col-sm-2">                
                <img  src="<?php echo e(asset('imagenes/logos/logoarchinet.png')); ?>" alt="Logo Archinet"/>
            </div>
        </header>
        <?php echo $__env->yieldContent("body"); ?>
        

            <?php echo $__env->make('layouts.secciones.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        

        <?php if(Auth::guest()): ?>
            <?php echo $__env->make('bienvenido.modales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

        <input type="hidden" id="general_url" value="<?php echo e(url('/')); ?>">
        <input type="hidden" id="general_token" value="<?php echo e(csrf_token()); ?>">}
        <script src="<?php echo e(asset('MDB-Free/js/jquery-3.2.1.min.js')); ?>"></script>
        <script src="<?php echo e(asset('MDB-Free/js/bootstrap.js')); ?>"></script>
        <script src="<?php echo e(asset('MDB-Free/js/mdb.js')); ?>"></script>
        <script src="<?php echo e(asset('js/numeric.js')); ?>"></script>
        <?php echo $__env->yieldPushContent('js'); ?>
    </body>
</html>