<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('cantidad_folios','Cantidad de folios (*)', ['class'=>'active']); ?>

        <?php echo Form::text('cantidad_folios',null,['id'=>'cantidad_folios','class'=>'form-control numeric valid-restrict-field no-paste required_field','data-required'=>'Debe escribir la cantidad de folios']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('fecha_documento','Fecha del documento', ['class'=>'active']); ?>

        <?php echo Form::date('fecha_documento',null,['id'=>'fecha_documento','class'=>'form-control no-paste','max'=>date('Y-m-d')]); ?>

    </div>
</div>

<div class="col-12 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('descripcion','Descripción', ['class'=>'active']); ?>

        <?php echo Form::text('descripcion',null,['id'=>'descripcion','class'=>'form-control valid-restrict-field no-paste','data-field']); ?>

    </div>
</div>

<div class="col-12">
    <div class="md-form">
        <?php echo Form::label('observaciones','Observaciones', ['class'=>'active']); ?>

        <?php echo Form::text('observaciones',null,['id'=>'observaciones','class'=>'form-control valid-restrict-field','data-field']); ?>

    </div>
</div>