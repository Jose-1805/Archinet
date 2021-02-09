<p>Su cuenta de usuario con el rol de <strong><?php echo e($usuario->roles()->first()->nombre); ?></strong> ha sido creada con éxito en el sistema web de <a href="<?php echo e(url('/')); ?>"><?php echo e(config('app.name', 'nuestro sistema')); ?></a>.</p>

<p>Para ingresar al sistema ingrese a este <a href="<?php echo e(url('/create-password/'.$usuario->token.'/'.\Illuminate\Support\Facades\Crypt::encrypt($usuario->id))); ?>">link</a> y registre su contraseña de ingreso.</p>
