<div class="col-12 col-md-6 col-lg-8">
    <div class="md-form">
        <?php echo Form::label('numero_acta','Número de acta', ['class'=>'active']); ?>

        <?php echo Form::text('numero_acta',null,['id'=>'numero_acta','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('fecha','Fecha', ['class'=>'active']); ?>

        <?php echo Form::date('fecha',null,['id'=>'fecha','class'=>'form-control']); ?>

    </div>
</div>