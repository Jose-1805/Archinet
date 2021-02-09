<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('fecha_inicio','Fecha de inicio', ['class'=>'active']); ?>

        <?php echo Form::date('fecha_inicio',null,['id'=>'fecha_inicio','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('fecha_fin','Fecha de fin', ['class'=>'active']); ?>

        <?php echo Form::date('fecha_fin',null,['id'=>'fecha_fin','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('calificacion_cualitativa','Calificación cualitativa', ['class'=>'active']); ?>

        <?php echo Form::text('calificacion_cualitativa',null,['id'=>'calificacion_cualitativa','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('calificacion_cuantitativa','Calificación cuantitativa', ['class'=>'active']); ?>

        <?php echo Form::text('calificacion_cuantitativa',null,['id'=>'calificacion_cuantitativa','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-8">
    <div class="md-form">
        <?php echo Form::label('evaluador','Nombre de evaluador', ['class'=>'active']); ?>

        <?php echo Form::text('evaluador',null,['id'=>'evaluador','class'=>'form-control']); ?>

    </div>
</div>