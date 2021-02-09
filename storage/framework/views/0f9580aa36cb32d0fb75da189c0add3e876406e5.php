<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Inicio de sesión</div>
                <div class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="md-form">
                            <label for="email" class="control-label active">Correo</label>

                            <div class="">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong class="text-danger"><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="md-form">
                            <label for="password" class="control-label active">Contraseña</label>

                            <div class="">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="md-form">
                            <div class="">
                                  <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Recordarme
                            </div>
                        </div>

                        <div class="md-form">
                            <div class="">
                                <button type="submit" class="btn btn-success">
                                    Ingresar
                                </button>

                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    ¿Ha olvidado su contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>