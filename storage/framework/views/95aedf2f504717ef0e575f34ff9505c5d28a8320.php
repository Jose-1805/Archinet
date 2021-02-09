<?php ($opciones = isset($opciones)?$opciones:true); ?>
<nav class="row">
    <div class="col-12 padding-top-none">
        <div class="col-12 perfiladmin padding-top-none">
            <div class="row">
                <div class="col-12 padding-bottom-10 padding-top-none">

                    <div class="row d-none d-md-inline">
                        <div class="col-12 padding-top-none padding-bottom-none" style="margin-bottom: -15px;">
                            <i class="white-text fas fa-user-circle fa-4x"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-9 padding-bottom-none">
                            <h6 class="white-text d-flex align-items-center">

                                <i class="fas fa-user-circle margin-right-5 d-inline d-md-none"></i>

                                <span class="text-left"><?php echo e(Auth::user()->fullName()); ?></span>
                            </h6>
                        </div>
                        <div class="col-3 padding-bottom-none">
                            <a class="right btn-toggle-menu white-text margin-left-5 d-inline d-md-none" href="#!">
                                <i class="fas fa-bars"></i>
                            </a>
                            <a class="white-text right" id="link-configuracion" href="<?php echo e(url('/configuracion')); ?>"><i class="fas fa-cogs"></i></a>
                        </div>
                        <div class="col-12 text-left padding-top-none" style="">
                            <i class="white-text font-small font-weight-600"><?php echo e(session('rol')->nombre); ?></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php if($opciones): ?>
        <div class="col-12 padding-top-none">
        <ul class="nav flex-column padding-top-2">
            <?php 
                $class_active_bg = 'unique-color font-weight-bold';
                $class_active_text = 'white-text';
                $class_no_active_text = 'teal-text';
             ?>
            <?php if(session('rol')->superadministrador == "si"): ?>
                <?php echo $__env->make('layouts.menus.opciones_superadministrador',['class_active_bg'=>$class_active_bg, 'class_active_text'=>$class_active_text, 'class_no_active_text'=>$class_no_active_text], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php elseif(session('rol')->funcionario == "si"): ?>
                <?php echo $__env->make('layouts.menus.opciones_funcionario',['class_active_bg'=>$class_active_bg, 'class_active_text'=>$class_active_text, 'class_no_active_text'=>$class_no_active_text], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('layouts.menus.opciones_user',['class_active_bg'=>$class_active_bg, 'class_active_text'=>$class_active_text, 'class_no_active_text'=>$class_no_active_text], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link mayuscula font-small d-flex align-items-center <?php echo e($class_no_active_text); ?>" href="<?php echo e(route('logout')); ?>"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <div style="width: 30px;">
                        <i class="fas fa-sign-out-alt font-large margin-right-10"></i>
                    </div>
                    Salir
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>
            </li>
        </ul>
    </div>
    <?php endif; ?>
</nav>
