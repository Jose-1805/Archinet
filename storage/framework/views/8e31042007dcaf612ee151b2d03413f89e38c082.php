<?php 
    $tipos_empresa = [
        ''=>'Seleccione',
        'Interna'=>'Interna',
        'Externa'=>'Externa'
    ];

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
<div class="col-12 col-md-6 col-lg-4 " id="contenedor_tipo_empresa">
    <div class="">
        <?php echo Form::label('tipo','Tipo de empresa (*)', ['class'=>'active']); ?>

        <?php echo Form::select('tipo',$tipos_empresa,null,['id'=>'tipo','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_laboral d-none">
    <div class="md-form" id="contenedor_fecha_vinculacion">
        <?php echo Form::label('fecha_vinculacion','Fecha de vinculación (*)', ['class'=>'active']); ?>

        <?php echo Form::date('fecha_vinculacion',null,['id'=>'fecha_vinculacion','class'=>'form-control valid-restrict-field no-paste required_field','max'=>date('Y-m-d'),'data-required'=>'Debe seleccionar una fecha de vinculación','data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_laboral d-none">
    <div class="md-form" id="contenedor_fecha_terminacion">
        <?php echo Form::label('fecha_terminacion','Fecha de terminación (*)', ['class'=>'active']); ?>

        <?php echo Form::date('fecha_terminacion',null,['id'=>'fecha_terminacion','class'=>'form-control valid-restrict-field no-paste required_field','max'=>date('Y-m-d'),'data-required'=>'Debe seleccionar una fecha de terminación','data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_laboral d-none">
    <div class="md-form">
        <?php echo Form::label('asignacion_mensual','Asignación mensual (*)', ['class'=>'active']); ?>

        <?php echo Form::text('asignacion_mensual',null,['id'=>'asignacion_mensual','class'=>'form-control required_field numeric valid-restrict-field no-paste valid_lenght','data-min-length'=>'6','maxlength'=>'8','data-required'=>'Debe escribir una asignación mensual','data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_laboral d-none empresa_interna">
    <div class="md-form">
        <?php echo Form::label('regional','Regional (*)', ['class'=>'active']); ?>

        <?php echo Form::text('regional',null,['id'=>'regional','class'=>'form-control alphabetical valid-restrict-field no-paste required_field valid_lenght','data-min-length'=>'4','maxlength'=>'45','data-required'=>'Debe escribir una regional','data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4  campo_certificado_laboral d-none empresa_interna">
    <div class="">
        <?php echo Form::label('tipo_nombramiento','Tipo de nombramiento (*)', ['class'=>'active']); ?>

        <?php echo Form::select('tipo_nombramiento',$tipos_nombramiento,null,['id'=>'tipo_nombramiento','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4  campo_certificado_laboral d-none empresa_interna">
    <div class="">
        <?php echo Form::label('cargo','Cargo (*)', ['class'=>'active']); ?>

        <?php echo Form::select('cargo',$cargos,null,['id'=>'cargo','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4  campo_certificado_laboral d-none empresa_externa">
    <div class="">
        <?php echo Form::label('cargo_externa','Cargo (*)', ['class'=>'active']); ?>

        <?php echo Form::text('cargo_externa',null,['id'=>'cargo_externa','class'=>'form-control alphabetical_space valid-restrict-field no-paste required_field valid_lenght','data-min-length'=>'4','maxlength'=>'150','data-required'=>'Debe escribir un cargo','data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_laboral d-none empresa_interna">
    <div class="">
        <?php echo Form::label('grado','Grado (*)', ['class'=>'active']); ?>

        <?php echo Form::select('grado',$grados,null,['id'=>'grado','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_laboral d-none empresa_externa">
    <div class="md-form">
        <?php echo Form::label('empresa','Nombre empresa (*)', ['class'=>'active']); ?>

        <?php echo Form::text('empresa',null,['id'=>'empresa','class'=>'form-control alphabetical_space valid-restrict-field no-paste required_field valid_lenght','data-min-length'=>'4','maxlength'=>'60','data-required'=>'Debe escribir una empresa','data-field']); ?>

    </div>
</div>

<script>
    $(function () {
        $('body').on('change','#tipo',function () {
            var tipo = $(this).val();
            $('#contenedor_tipo_empresa').addClass('d-none');

            if(tipo == 'Interna'){
                $('#titulo_tipo_documental').html('CERTIFICACION LABORAL TIPO DE EMPRESA INTERNA');
                $('.campo_certificado_laboral').removeClass('d-none');
                $('.campo_certificado_laboral.empresa_externa').addClass('d-none');
                $('#asignacion_mensual').addClass('required_field');
                $('#asignacion_mensual').parent().children('label').html('Asignación mensual (*)');

            }else if(tipo == 'Externa'){
                $('#titulo_tipo_documental').html('CERTIFICACION LABORAL TIPO DE EMPRESA EXTERNA');
                $('.campo_certificado_laboral').removeClass('d-none');
                $('.campo_certificado_laboral.empresa_interna').addClass('d-none');
                $('#asignacion_mensual').removeClass('required_field');
                $('#asignacion_mensual').parent().children('label').html('Asignación mensual');
            }else{
                $('.campo_certificado_laboral').addClass('d-none');
            }
        })

        $('#fecha_vinculacion').change(function () {
            var fecha_fin = $('#fecha_terminacion').val();
            if(fecha_fin){
                fecha_fin = new Date(fecha_fin);
                fecha_inicio = new Date($(this).val());
                if(fecha_fin.getTime() <= fecha_inicio.getTime()){
                    abrirMensajesValidacion('contenedor_fecha_vinculacion',"danger",{'fecha_vinculacion':['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha terminación" ']});
                }else{
                    var id = $(this).attr('id');
                    var data = '{"' + id + '":[""]}';
                    data = JSON.parse(data);
                    var parar = false;
                    var id_contenedor = '';
                    var element = $(this).parent().parent();
                    while (!parar) {
                        if ($(element).attr('id')) {
                            parar = true;
                            id_contenedor = $(element).attr('id');
                        } else {
                            element = $(element).parent();
                        }
                    }
                    abrirMensajesValidacion(id_contenedor,"success",data);
                }
            }else{
                var id = $(this).attr('id');
                var data = '{"' + id + '":[""]}';
                data = JSON.parse(data);
                var parar = false;
                var id_contenedor = '';
                var element = $(this).parent().parent();
                while (!parar) {
                    if ($(element).attr('id')) {
                        parar = true;
                        id_contenedor = $(element).attr('id');
                    } else {
                        element = $(element).parent();
                    }
                }
                abrirMensajesValidacion(id_contenedor,"success",data);
            }
        });

        $('#fecha_terminacion').change(function () {
            var fecha_inicio = $('#fecha_vinculacion').val();
            if(fecha_inicio){
                fecha_inicio = new Date(fecha_inicio);
                fecha_fin = new Date($(this).val());
                if(fecha_fin.getTime() <= fecha_inicio.getTime()){
                    abrirMensajesValidacion('contenedor_fecha_terminacion',"danger",{'fecha_terminacion':['no es posible seleccionar una fecha menor o igual a la establecida en el campo "fecha vinculación"']});
                }else{
                    var id = $(this).attr('id');
                    var data = '{"' + id + '":[""]}';
                    data = JSON.parse(data);
                    var parar = false;
                    var id_contenedor = '';
                    var element = $(this).parent().parent();
                    while (!parar) {
                        if ($(element).attr('id')) {
                            parar = true;
                            id_contenedor = $(element).attr('id');
                        } else {
                            element = $(element).parent();
                        }
                    }
                    abrirMensajesValidacion(id_contenedor,"success",data);
                }
            }else{
                var id = $(this).attr('id');
                var data = '{"' + id + '":[""]}';
                data = JSON.parse(data);
                var parar = false;
                var id_contenedor = '';
                var element = $(this).parent().parent();
                while (!parar) {
                    if ($(element).attr('id')) {
                        parar = true;
                        id_contenedor = $(element).attr('id');
                    } else {
                        element = $(element).parent();
                    }
                }
                abrirMensajesValidacion(id_contenedor,"success",data);
            }
        });

    })
</script>