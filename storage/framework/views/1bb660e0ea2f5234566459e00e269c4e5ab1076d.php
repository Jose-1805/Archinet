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
    <link href="<?php echo e(asset('css/global.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/paginaprincipal.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/principal.css')); ?>" rel="stylesheet" type="text/css">

    <style>
        /* Required for full background image */

        html,
        body,
        header,
        .view {
            height: 100%;
        }

        @media (max-width: 740px) {
            html,
            body,
            header,
            .view {
                height: 1100px;
            }
        }
        @media (min-width: 800px) and (max-width: 850px) {
            html,
            body,
            header,
            .view {
                height: 700px;
            }
        }
        .footer {
            position: static;
            height: auto;
            padding: 3rem 3rem;
        }
    </style>
</head>

<body>
<header>
    <div class="view" style="background-image: url('<?php echo e(asset('imagenes/bienvenido/slider.jpg')); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-10 offset-md-1 align-items-center">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-3 no-padding">
                                <a href="<?php echo e(url('/')); ?>"><img class="right" src="<?php echo e(asset('imagenes/logos/logo_sena_blanco.png')); ?>" style="height: 120px; margin: 1cm;" alt="Logo SENA"/></a>
                            </div>
                            <div style="background-color: #FFF;height: 80px;width: 1px;"></div>
                            <div class="col white-text no-padding">
                                <h1 class="white-text" style="padding-left: 1cm;"><?php echo e($mensaje); ?></h1>
                                <h2 class="white-text" style="padding-left: 1cm;">Código de error: <?php echo e($estado); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div>
    <?php echo $__env->yieldContent("body"); ?>
</div>

<?php echo $__env->make('layouts.secciones.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<input type="hidden" id="general_url" value="<?php echo e(url('/')); ?>">
<input type="hidden" id="general_token" value="<?php echo e(csrf_token()); ?>">

<script src="<?php echo e(asset('MDB-Free/js/jquery-3.2.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('MDB-Free/js/bootstrap.js')); ?>"></script>
<script src="<?php echo e(asset('MDB-Free/js/mdb.js')); ?>"></script>
<script src="<?php echo e(asset('js/numeric.js')); ?>"></script>
<script src="<?php echo e(asset('js/bienvenido.js')); ?>"></script>
<script src="<?php echo e(asset('js/blockUi.js')); ?>"></script>>
<script src="<?php echo e(asset('js/global.js')); ?>"></script>
<?php echo $__env->yieldPushContent('js'); ?>
</body>
</html>