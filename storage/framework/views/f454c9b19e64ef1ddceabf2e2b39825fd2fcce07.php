<li class="nav-item <?php echo e(Request::is('expediente/*') ||  Request::is('expediente')? $class_active_bg:''); ?>">
    <a class="nav-link mayuscula font-small d-flex align-items-center
        <?php echo e(Request::is('expediente/*') ||  Request::is('expediente')? $class_active_text:$class_no_active_text); ?>

            " href="<?php echo e(url('/expediente')); ?>">
        <div style="width: 30px;">
            <i class="fas fa-address-card font-large margin-right-10"></i>
        </div>
        Mi Expediente
    </a>
</li>

<li class="nav-item <?php echo e(Request::is('certificado/*') ||  Request::is('certificado')? $class_active_bg:''); ?>">
    <a class="nav-link mayuscula font-small d-flex align-items-center
        <?php echo e(Request::is('certificado/*') ||  Request::is('certificado')? $class_active_text:$class_no_active_text); ?>

            " href="<?php echo e(url('/certificado')); ?>">
        <div style="width: 30px;">
            <i class="fas fa-certificate font-large margin-right-10"></i>
        </div>
        Mis Certificados
    </a>
</li>