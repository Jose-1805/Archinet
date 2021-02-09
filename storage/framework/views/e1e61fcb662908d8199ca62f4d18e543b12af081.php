<?php $__env->startSection('form'); ?>
    <div class="card">
        <div class="card-body z-depth-2">
            <!--Header-->
            <div class="">
                <h3 class="dark-grey-text">
                    <strong class="">Ingresar</strong>
                </h3>
                <div class="blue" style="">
                    <img class="right" src="<?php echo e(asset('imagenes/logos/logoarchinet.png')); ?>" style="height: 50px;margin-top: -60px;" alt="Logo SENA"/>
                </div>
            </div>
            <hr>

            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="md-form">
                    <label for="email" class="control-label">Correo</label>

                    <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" autofocus placeholder="Escriba su correo">

                    <?php if($errors->has('email')): ?>
                        <span class="help-block text-danger">
                            <strong class="text-danger"><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="md-form">
                    <label for="password" class="control-label">Contraseña</label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Escriba su contraseña">
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong class="text-danger"><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="">
                    <label>
                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Recordarme
                    </label>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">
                        Ingresar
                    </button>
                </div>

                <div class="text-center">
                    <a class="" href="<?php echo e(route('password.request')); ?>">
                        ¿Ha olvidado su contraseña?
                    </a>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
    <?php if(Auth::guest()): ?>
        <?php echo $__env->make('bienvenido.modales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>