<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('nombre','Nombre', ['class'=>'active']); ?>

        <?php echo Form::text('nombre',null,['id'=>'nombre','class'=>'form-control']); ?>

    </div>
</div>

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