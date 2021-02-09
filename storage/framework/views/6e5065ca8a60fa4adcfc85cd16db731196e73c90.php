<?php (
    $novedades = [
        ''=>'Seleccione',
        'Ordinario'=>'Ordinario',
        'Nombramiento provicional'=>'Nombramiento provicional',
        'Asenso'=>'Asenso',
        'Periodo de prueba y de encargo'=>'Periodo de prueba y de encargo'
    ]
); ?>
<div class="col-12">
    <div class="md-form">
        <?php echo Form::label('novedad_ingreso','Novedad de ingreso', ['class'=>'active padding-bottom-10']); ?>

        <?php echo Form::select('novedad_ingreso',$novedades,null,['id'=>'novedad_ingreso','class'=>'form-control margin-top-10']); ?>

    </div>
</div>