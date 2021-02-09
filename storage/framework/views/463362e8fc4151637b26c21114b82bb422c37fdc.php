<?php $__env->startSection('form'); ?>
    <div class="card">
        <div class="card-body">
            <div class="">
                <h3 class="dark-grey-text">
                    <strong class="">Bienvenido a <?php echo e(config('app.name','nuestro sistema')); ?>!</strong>
                </h3>
            </div>
            <hr>

            <div class="">
                <?php echo $__env->make('layouts.alertas',['id_contenedor'=>'alertas-create-password'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="">
                <p class="">Señor(a) <?php echo e($user->fullName()); ?>, para ingresar al sistema ingrese una contraseña de acceso y la verificación de la misma.</p>
                <?php echo Form::open(['id'=>'form-create-password']); ?>

                <div class="">
                    <div class="md-form">
                        <?php echo Form::label('password','Contraseña (*)'); ?>

                        <?php echo Form::password('password',['id'=>'password','class'=>'form-control']); ?>

                    </div>

                    <div class="md-form margin-top-20">
                        <?php echo Form::label('password_confirm','Confirmación de contraseña (*)'); ?>

                        <?php echo Form::password('password_confirm',['id'=>'password_confirm','class'=>'form-control']); ?>

                    </div>

                    <div class="md-form margin-top-10">
                        <a href="#!" class="btn-submit btn btn-block btn-success margin-top-5" id="btn-create-password">Guardar</a>
                    </div>
                    <?php echo Form::hidden('id',$user->id); ?>

                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('js/usuario/create_password.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app_guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>