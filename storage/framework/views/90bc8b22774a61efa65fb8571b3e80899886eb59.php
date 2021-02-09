<div class="row">
    <h5 class="col-12 mayuscula" id="titulo_tipo_documental"><?php echo e($tipo_documental->nombre); ?></h5>
    <div class="col-12">
        <div class="col-12 border">
            <div class="row">
                <?php echo $__env->make('expediente.documentos.secciones.datos_basicos_tipo_documental', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php ($view = 'expediente.documentos.secciones.'.$tipo_documental->seccion->nombre_carpeta.'.'.$tipo_documental->carpeta.'.datos_form'); ?>

                <?php if(\Illuminate\Support\Facades\View::exists($view)): ?>
                    <?php echo $__env->make($view, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>

                <div class="col-12 grey lighten-4 padding-top-20 margin-top-20 padding-bottom-20">
                    <?php if(Auth::user()->tieneFuncion($identificador_modulo, 'validar_documentos', $privilegio_superadministrador)): ?>
                        <?php ($checked = ''); ?>
                        <?php if(isset($documento) && $documento->validado == 'si'): ?>
                            <?php ($checked = 'checked'); ?>
                        <?php endif; ?>
                        <label>
                            <input type="checkbox" name="validar" value="si" <?php echo e($checked); ?>> Seleccione si el documento está validado
                        </label>
                    <?php endif; ?>
                    <div class="md-form margin-top-30" id="contenedor-upload">
                        <?php echo Form::label('archivo','Archivo', ['class'=>'active padding-bottom-10']); ?>

                        <?php echo Form::file('archivo',['id'=>'archivo','class'=>'form-control', 'accept'=>'application/pdf']); ?>

                    </div>
                </div>
                <?php echo Form::hidden('tipo_documental',$tipo_documental->id); ?>

            </div>
        </div>
    </div>
</div>