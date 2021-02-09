<?php $__env->startSection('form'); ?>
    <div class="card">
        <div class="card-body">
            <div class="">
                <h4 class="dark-grey-text">
                    <strong class="">Restablecer contraseña</strong>
                </h4>
            </div>
            <hr>

            <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('password.email')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="md-form<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <label for="email" class="control-label">Correo electrónico</label>

                    <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required placeholder="Escriba su correo electrónico">

                    <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="md-form">
                    <div class="col-12 text-center no-padding margin-top-20">
                        <button type="submit" class="btn btn-success btn-block">
                            Solicitar restablecimiento
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>