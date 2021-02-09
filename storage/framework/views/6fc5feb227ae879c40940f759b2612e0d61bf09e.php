<?php ($configuracion = \Archinet\Models\Configuracion::orderBy('id','DESC')->first()); ?>
<?php ($configuracion = $configuracion?$configuracion:new \Archinet\Models\Configuracion()); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Mis certificados</p>

            <div class="col-12 no-padding">
                <?php echo $__env->make('layouts.alertas',['id_contenedor'=>'alertas-certificados'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-12 grey lighten-4 padding-bottom-30">
                <div class="row">
                    <div class="col-12 col-md-6 text-center">
                        <h5 class="text-center mayuscula">Certificado básico</h5>
                        <a class="btn btn-default" id="btn-certificado-basico">Generar</a>
                    </div>

                    <div class="col-12 col-md-6 text-center">
                        <h5 class="text-center mayuscula">Certificado detallado</h5>
                        <a class="btn btn-default text-center" id="btn-certificado-detallado">Solicitar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Side Modal Top Right -->

    <!-- To change the direction of the modal animation change .right class -->
    <div class="modal fade right" id="modal_certificado_detallado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
        <div class="modal-dialog modal-side modal-bottom-right" style="min-width: 50%;" role="document">
            <div class="modal-content grey darken-2">
                <div class="modal-header grey darken-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="white-text" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body white">
                    <?php echo Form::open(['id'=>'form-certificado-detallado']); ?>

                        <?php if(!$configuracion->correo_solicitud_certificados): ?>
                            <div class="alert alert-danger">
                                <p>En este momento no es posible enviar la solicitud de certificado detallado debido a que no se ha configurado debidamente el sistema.</p>
                            </div>
                        <?php endif; ?>
                        <div class="col-12 padding-right-none padding-left-none">
                            <?php echo Form::label('destinatario','Destinatario (*)'); ?>

                            <?php echo Form::text('destinatario',$configuracion->correo_solicitud_certificados,['id'=>'destinatario','class'=>'form-control', 'disabled'=>'disabled']); ?>

                        </div>
                        <div class="col-12 padding-right-none padding-left-none">
                            <?php echo Form::label('asunto','Asunto (*)'); ?>

                            <?php echo Form::text('asunto',null,['id'=>'asunto','class'=>'form-control valid_lenght valid-restrict-field no-paste required_field','data-required'=>'Debe escribir un asunto','data-field'=>'','data-min-length'=>3,'maxlength'=>250]); ?>

                        </div>
                        <div class="col-12 padding-right-none padding-left-none">
                            <?php echo Form::label('descripcion','Descripción (*)'); ?>

                            <?php echo Form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control valid-restrict-field required_field', 'data-required'=>'Debe escribir una descripción','data-field'=>'','rows'=>'5']); ?>

                        </div>
                    <?php echo Form::close(); ?>

                </div>
                <div class="modal-footer white">
                    <div class="container no-padding">
                        <div class="row">
                            <div class="col-12 text-left">
                                <?php if($configuracion->correo_solicitud_certificados): ?>
                                    <button type="button" class="btn btn-primary" id="btn-enviar-solicitud-detallado">Enviar</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Side Modal Top Right -->

    <div class="modal fade right" id="modal_tramite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Trámite</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="white-text" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body white">
                    <p>Seleccione el tipo de trámite para el cual requiere el certificado.</p>
                    <?php echo Form::select('tramite',[''=>'Seleccione','Trámite bancario'=>'Trámite bancario','Acreditar experiencia'=>'Acreditar experiencia'],null,['id'=>'tramite','class'=>'form-control']); ?>

                </div>
                <div class="modal-footer white">
                    <div class="container no-padding">
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-block" id="btn-generar-basico-tramite">Generar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('js/certificado/index.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>