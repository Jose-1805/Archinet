<?php $__env->startSection('form'); ?>
    <div class="card">
        <div class="card-body">

            <div class="">
                <h3 class="dark-grey-text">
                    <strong class="">Restablecer contraseña</strong>
                </h3>
            </div>
            <hr>

            <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <form id="form_reset_password" class="form-horizontal" role="form" method="POST" action="<?php echo e(route('password.request')); ?>">
                <?php echo e(csrf_field()); ?>


                <input type="hidden" name="token" value="<?php echo e($token); ?>">

                <div class="md-form<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <label for="email" class="control-label">Correo electrónico</label>

                    <input id="email" type="email" class="form-control valid-restrict-field no-paste mail required_field" data-required="Introduzca una dirección de correo electrónico" name="email" value="<?php echo e(isset($email) ? $email : old('email')); ?>" required autofocus placeholder="Escriba su correo">

                    <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="md-form<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <label for="password" class="control-label">Contraseña</label>

                    <input id="password" type="password" class="form-control valid-restrict-field no-paste valid_lenght required_field" data-field="contraseña" data-min-length="8" maxlength="30" data-required="Debe escribir una contraseña" name="password" required placeholder="Escriba su contraseña">

                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="md-form<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                    <label for="password-confirm" class="control-label">Confirmación de contraseña</label>
                    <input id="password-confirm" type="password" class="form-control valid-restrict-field no-paste valid_lenght required_field" data-field="confirmación de contraseña" data-min-length="8" maxlength="30" data-required="Por favor confirme su contraseña" name="password_confirmation" required placeholder="Vuelva a escribir su contraseña">

                    <?php if($errors->has('password_confirmation')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="md-form">
                    <div class="col-12 text-center no-padding margin-top-20">
                        <button type="submit" class="btn btn-success btn-block">
                            Aceptar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>