<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('numero_radicado','Nª radicado', ['class'=>'active']); ?>

        <?php echo Form::text('numero_radicado',null,['id'=>'numero_radicado','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('fecha','Fecha de vinculación a la empresa', ['class'=>'active']); ?>

        <?php echo Form::date('fecha',null,['id'=>'fecha','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('nombre_centro','Nombre de centro', ['class'=>'active']); ?>

        <?php echo Form::text('nombre_centro',null,['id'=>'nombre_centro','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-12">
    <div class="md-form">
        <?php echo Form::label('cargo','Cargo', ['class'=>'active']); ?>

        <?php echo Form::text('cargo',null,['id'=>'cargo','class'=>'form-control']); ?>

    </div>
</div>