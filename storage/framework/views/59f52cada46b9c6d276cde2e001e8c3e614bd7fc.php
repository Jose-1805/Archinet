<?php
    $tipos_nombramiento = [
        ''=>'Seleccione',
        'Periodo de prueba' => 'Periodo de prueba',
        'Carrera administrativa' => 'Carrera administrativa',
        'Provisional' => 'Provisional',
        'Ordinario' => 'Ordinario',
        'Trabajador oficial' => 'Trabajador oficial',
        'Ascenso' => 'Ascenso',
        'Incorporación' => 'Incorporación',
    ];

    $tipos_novedades = [
        ''=>'Seleccione',
        'Encargo'=>'Encargo',
        'Comisión de servicio'=>'Comisión de servicio',
        'Traslado'=>'Traslado',
        'Asignación de funciones'=>'Asignación de funciones',
    ];

    $dependencias = [
        ''=>'Seleccione',
        'Despacho de dirección'=>'Despacho de dirección',
        'Centro agropecuario'=>'Centro agropecuario',
        'Centro de comercio y servicios'=>'Centro de comercio y servicios',
        'Centro de teleinformatica y producción industrial'=>'Centro de teleinformatica y producción industrial'
    ];

    $cargos = [
        ''=>'Seleccione',
        'Auxiliar'=>'Auxiliar',
        'Oficinista'=>'Oficinista',
        'Secretaria'=>'Secretaria',
        'Técnico'=>'Técnico',
        'Profesional'=>'Profesional',
        'Subdirector de centro'=>'Subdirector de centro',
        'Asesor'=>'Asesor',
        'Director regional B'=>'Director regional B',
        'Instructor'=>'Instructor',
        'Aseador(a)'=>'Aseador(a)',
        'Conductor'=>'Conductor',
        'Trabajador de campo'=>'Trabajador de campo',
        'Oficial mantto general'=>'Oficial mantto general'
    ];

    $grados = [''=>'Seleccione'];

    for($i = 1;$i <= 20;$i++)
        $grados[$i] = $i;
?>
<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('numero_acta','Nª de acta (*)', ['class'=>'active']); ?>

        <?php echo Form::text('numero_acta',null,['id'=>'numero_acta','class'=>'form-control numeric valid-restrict-field no-paste required_field valid_lenght','data-min-length'=>'2','maxlength'=>'6','data-required'=>'Debe escribir un número de acta','data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('fecha_nombramiento','Fecha de nombramiento (*)', ['class'=>'active']); ?>

        <?php echo Form::date('fecha_nombramiento',null,['id'=>'fecha_nombramiento','class'=>'form-control valid-restrict-field no-paste required_field','max'=>date('Y-m-d'),'data-required'=>'Debe seleccionar una fecha de nombramiento','data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 ">
    <div class="">
        <?php echo Form::label('tipo_nombramiento','Tipo de nombramiento', ['class'=>'active']); ?>

        <?php echo Form::select('tipo_nombramiento',$tipos_nombramiento,null,['id'=>'tipo_nombramiento','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 ">
    <div class="">
        <?php echo Form::label('tipo_novedad','Tipo de novedad', ['class'=>'active']); ?>

        <?php echo Form::select('tipo_novedad',$tipos_novedades,null,['id'=>'tipo_novedad','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 ">
    <div class="">
        <?php echo Form::label('dependencia','Dependencia (*)', ['class'=>'active']); ?>

        <?php echo Form::select('dependencia',$dependencias,null,['id'=>'dependencia','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 ">
    <div class="">
        <?php echo Form::label('cargo','Cargo (*)', ['class'=>'active']); ?>

        <?php echo Form::select('cargo',$cargos,null,['id'=>'cargo','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 ">
    <div class="">
        <?php echo Form::label('grado','Grado (*)', ['class'=>'active']); ?>

        <?php echo Form::select('grado',$grados,null,['id'=>'grado','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4">
    <div class="md-form">
        <?php echo Form::label('salario','Salario (*)', ['class'=>'active']); ?>

        <?php echo Form::text('salario',null,['id'=>'salario','class'=>'form-control numeric valid-restrict-field no-paste required_field valid_lenght','data-min-length'=>'5','maxlength'=>'8','data-required'=>'Debe escribir el salario','data-field']); ?>

    </div>
</div>

<script>
    $(function () {
        $('body').on('change','#tipo_nombramiento',function () {
            if($(this).val()){
                $('#tipo_novedad').prop('disabled',true);
                $('#tipo_novedad option').eq(0).prop('selected','selected');
                //se quitan los errores de tipo novedad
                var padre = $('#tipo_novedad').parent();
                $(padre).find('.contenedor-mensaje-validacion').remove();
                $(padre).removeClass('input-validado-danger');
            }else{
                $('#tipo_novedad').prop('disabled',false);
            }
        })
        $('body').on('change','#tipo_novedad',function () {
            if($(this).val()){
                $('#tipo_nombramiento').prop('disabled',true);
                $('#tipo_nombramiento option').eq(0).prop('selected','selected');

                //se quitan los errores de tipo nombramiento
                var padre = $('#tipo_nombramiento').parent();
                $(padre).find('.contenedor-mensaje-validacion').remove();
                $(padre).removeClass('input-validado-danger');
            }else{
                $('#tipo_nombramiento').prop('disabled',false);
            }
        })
    })
</script>