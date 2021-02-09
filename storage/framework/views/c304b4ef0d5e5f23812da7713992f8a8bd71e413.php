<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('nombre_institución','Nombre de institución', ['class'=>'active']); ?>

        <?php echo Form::text('nombre_institución',null,['id'=>'nombre_institución','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('titulo','Tíitulo obtenido', ['class'=>'active']); ?>

        <?php echo Form::text('titulo',null,['id'=>'titulo','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('fecha','Fecha de registro', ['class'=>'active']); ?>

        <?php echo Form::date('fecha',null,['id'=>'fecha','class'=>'form-control']); ?>

    </div>
</div>
<?php (
    $niveles_academicos = [
        ''=>'Seleccione',
        'Primaria'=>'Primaria',
        'Bachiller'=>'Bachiller',
        'Tecnico'=>'Tecnico',
        'Tecnologo'=>'Tecnologo',
        'Especialización en tecnologia'=>'Especialización en tecnologia'

    ]
); ?>
<div class="col-12 col-md-6">
    <div class="md-form">
        <?php echo Form::label('nivel_academico','Nivel académico', ['class'=>'active padding-bottom-10']); ?>

        <?php echo Form::select('nivel_academico',$niveles_academicos,null,['id'=>'nivel_academico','class'=>'form-control margin-top-10']); ?>

    </div>
</div>
<?php (
    $titulos_profesionales = [
        ''=>'Seleccione',
        'Pregrado'=>'Pregrado',
        'Especialización'=>'Especialización',
        'Maestría'=>'Maestría',
        'Doctorado'=>'Doctorado'
    ]
); ?>
<div class="col-12 col-md-6">
    <div class="md-form">
        <?php echo Form::label('titulo_profesional','Título profesional', ['class'=>'active padding-bottom-10']); ?>

        <?php echo Form::select('titulo_profesional',$titulos_profesionales,null,['id'=>'titulo_profesional','class'=>'form-control margin-top-10']); ?>

    </div>
</div>