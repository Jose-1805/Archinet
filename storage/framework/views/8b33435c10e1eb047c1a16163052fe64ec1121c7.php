<?php ($configuracion = \Archinet\Models\Configuracion::orderBy('id','DESC')->first()); ?>
<?php ($configuracion = $configuracion?$configuracion:new \Archinet\Models\Configuracion()); ?>
<div id="modal-contrasena" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Cambiar contraseña</h4>
            </div>
            <div class="modal-body">
                <div class="col-12 no-padding">
                    <?php echo $__env->make('layouts.alertas',['id_contenedor'=>'alertas-cambiar-password'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <?php echo Form::open(['id'=>'form-cambio-password']); ?>

                    <div class="row">
                        <div class="col-12 padding-top-none">
                            <div class="md-form">
                                <?php echo Form::label('password','Contraseña nueva'); ?>

                                <?php echo Form::password('password',['id'=>'password','class'=>'form-control valid-restrict-field no-paste required_field valid_lenght', 'data-required'=>'Debe escribir su nueva contraseña', 'data-min-length'=>8, 'maxlength'=>30, 'data-field'=>'contraseña nueva', 'placeholder'=>'Escriba su nueva contraseña']); ?>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="md-form">
                                <?php echo Form::label('password_confirm','Confirme su Contraseña'); ?>

                                <?php echo Form::password('password_confirm',['id'=>'password_confirm','class'=>'form-control valid-restrict-field no-paste required_field valid_lenght', 'data-required'=>'Debe volver a escribir su nueva contraseña', 'data-min-length'=>8, 'maxlength'=>30, 'data-field'=>'confirme su contraseña', 'placeholder'=>'Vuelva a escribir su nueva contraseña']); ?>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="md-form">
                                <?php echo Form::label('password_old','Contraseña antigua'); ?>

                                <?php echo Form::password('password_old',['id'=>'password_old','class'=>'form-control valid-restrict-field no-paste required_field valid_lenght', 'data-required'=>'Debe escribir su contraseña antigua', 'data-min-length'=>8, 'maxlength'=>30, 'data-field'=>'contraseña antigua', 'placeholder'=>'Escriba su contraseña antigua']); ?>

                            </div>
                        </div>
                    </div>
                <?php echo Form::close(); ?>

            </div>
            <div class="modal-footer">
                <a class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</a>
                <a class="btn btn-sm btn-primary" id="btn-cambiar-contrasena">Guardar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contrasena-actualizada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-notify modal-success" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title white-text" id="myModalLabel">Confirmación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Su contraseña ha sido actualizada correctamente
            </div>
            <div class="modal-footer">
                <a href="<?php echo e(url('/')); ?>" class="btn btn-outline-success waves-effect">Aceptar</a>
            </div>
        </div>
    </div>
</div>

<?php if(Auth::user()->esSuperadministrador()): ?>
    <div id="modal-correos" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Configurar correos</h4>
                </div>
                <div class="modal-body padding-top-none">
                    <?php echo Form::open(['id'=>'form-configurar-correos']); ?>

                        <div class="row padding-top-none">
                            <div class="col-12">
                                <div class="md-form">
                                    <?php echo Form::label('correo_solicitud_certificados','Correo para recibir solicitudes de certificado detallado (*)'); ?>

                                    <?php echo Form::text('correo_solicitud_certificados',$configuracion->correo_solicitud_certificados,['id'=>'correo_solicitud_certificados','class'=>'form-control valid_lenght mail valid-restrict-field no-paste required_field','data-required'=>'Debe escribir un correo','data-field'=>'','data-min-length'=>5,'maxlength'=>150]); ?>

                                </div>
                            </div>
                        </div>
                    <?php echo Form::close(); ?>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-sm btn-default" data-dismiss="modal">Cancelar</a>
                    <a class="btn btn-sm btn-primary" id="btn-configurar-correos">Guardar</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>