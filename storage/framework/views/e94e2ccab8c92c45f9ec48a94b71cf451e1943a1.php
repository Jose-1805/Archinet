<?php 
    if(!isset($metadatos)) $metadatos = new \Archinet\Models\Metadato();
    $tipos = [
        ''=>'Seleccione',
        'Formal'=>'Formal',
        'No Formal'=>'No Formal'
    ];

    $niveles_estudio_formal = [
        ''=>'Seleccione',
        'Primaria' => 'Primaria',
        'Secundaria' => 'Secundaria',
        'Profesional' => 'Profesional',
        'Maestría' => 'Maestría',
        'Doctorado' => 'Doctorado',
        'Especialización' => 'Especialización',
        'Técnico' => 'Técnico',
        'Tecnologo' => 'Tecnologo',
        'Especialización tegnológica' => 'Especialización tegnológica'
    ];

    $niveles_estudio_no_formal = [
        ''=>'Seleccione',
        'Cursos' => 'Cursos',
        'Talleres' => 'Talleres',
        'Seminarios' => 'Seminarios',
        'Simposio' => 'Simposio',
        'Capacitaciones' => 'Capacitaciones',
        'Congresos' => 'Congresos'
    ];

    $tipos_duracion = [
        ''=>'Seleccione',
        'Horas' => 'Horas',
        'Días' => 'Días',
        'Semanas' => 'Semanas',
        'Meses' => 'Meses',
        'Trimestres' => 'Trimestres',
        'Semestres' => 'Semestres',
        'Años' => 'Años',
        'Ciclos' => 'Ciclos',
        'Niveles' => 'Niveles'
    ];
 ?>
<div class="col-12 col-md-6 col-lg-4 " id="contenedor_tipo">
    <div class="">
        <?php echo Form::label('tipo','Tipo (*)', ['class'=>'active']); ?>

        <?php echo Form::select('tipo',$tipos,null,['id'=>'tipo','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4  campo_certificado_estudio d-none estudio_formal">
    <div class="">
        <?php echo Form::label('nivel_estudio','Nivel de estudio (*)', ['class'=>'active']); ?>

        <?php echo Form::select('nivel_estudio',$niveles_estudio_formal,null,['id'=>'nivel_estudio','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4  campo_certificado_estudio d-none estudio_no_formal">
    <div class="">
        <?php echo Form::label('nivel_estudio_no_formal','Nivel de estudio (*)', ['class'=>'active']); ?>

        <?php echo Form::select('nivel_estudio_no_formal',$niveles_estudio_no_formal,$metadatos->nivel_estudio,['id'=>'nivel_estudio_no_formal','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4  campo_certificado_estudio d-none">
    <div class="">
        <?php echo Form::label('tipo_duracion','Tipo duración (*)', ['class'=>'active']); ?>

        <?php echo Form::select('tipo_duracion',$tipos_duracion,null,['id'=>'tipo_duracion','class'=>'form-control']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_estudio d-none">
    <div class="md-form">
        <?php echo Form::label('duracion','Duración (*)', ['class'=>'active']); ?>

        <?php echo Form::text('duracion',null,['id'=>'duracion','class'=>'form-control required_field numeric no-paste valid-restrict-field valid_lenght','data-required'=>'Debe escribir una duración','maxlength'=>'3']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_estudio d-none">
    <div class="md-form">
        <?php echo Form::label('institucion','Institución', ['class'=>'active']); ?>

        <?php echo Form::text('institucion',null,['id'=>'institucion','class'=>'form-control required_field alphabetical_space no-paste valid-restrict-field','data-required'=>'Debe escribir una institución','data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_estudio d-none estudio_formal">
    <div class="md-form">
        <?php echo Form::label('titulo_obtenido','Titulo obtenido (*)', ['class'=>'active']); ?>

        <?php echo Form::text('titulo_obtenido',null,['id'=>'titulo_obtenido','class'=>'form-control required_field alphabetical_space no-paste valid-restrict-field valid_lenght', 'data-required'=>'Debe escribir un título obtenido', 'data-min-length'=>'3', 'maxLength'=>'250', 'data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_estudio d-none estudio_no_formal">
    <div class="md-form">
        <?php echo Form::label('nombre_curso','Nombre del curso (*)', ['class'=>'active']); ?>

        <?php echo Form::text('nombre_curso',null,['id'=>'nombre_curso','class'=>'form-control required_field alphabetical_space no-paste valid-restrict-field valid_lenght', 'data-required'=>'Debe escribir un nombre de curso', 'data-min-length'=>'3', 'maxLength'=>'250', 'data-field']); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_estudio d-none">
    <div class="md-form">
        <?php echo Form::label('graduado','Graduado (*)', ['class'=>'active']); ?>

        <div class="padding-top-10 padding-bottom-30" id="graduado">
            <label for="graduado_si" style="position: relative;">
                <input type="radio" name="graduado" class="check-graduado" value="si" <?php if($metadatos->graduado == 'si'): ?> checked <?php endif; ?> id="graduado_si"/> Si
            </label>
            <label for="graduado_no" style="position: relative;margin-left: 15px;">
                <input type="radio" name="graduado" class="check-graduado" value="no" <?php if($metadatos->graduado == 'no'): ?> checked <?php endif; ?> id="graduado_no"/> No
            </label>
        </div>
    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_laboral d-none estudio_formal fechas_estudio_formal">
    <div class="md-form" id="contenedor_fecha_inicio">
        <?php echo Form::label('fecha_inicio','Fecha de inicio', ['class'=>'active']); ?>

        <?php echo Form::date('fecha_inicio',null,['id'=>'fecha_inicio','class'=>'form-control no-paste valid-restrict-field', 'max'=>date('Y-m-d')]); ?>

    </div>
</div>

<div class="col-12 col-md-6 col-lg-4 campo_certificado_laboral d-none estudio_formal fechas_estudio_formal">
    <div class="md-form" id="contenedor_fecha_fin">
        <?php echo Form::label('fecha_fin','Fecha fin (*)', ['class'=>'active']); ?>

        <?php echo Form::date('fecha_fin',null,['id'=>'fecha_fin','class'=>'form-control required_field no-paste valid-restrict-field', 'data-required'=>'Debe seleccionar una fecha', 'max'=>date('Y-m-d')]); ?>

    </div>
</div>

<script>
    $(function () {
        $('body').on('change','#tipo',function () {
            var tipo = $(this).val();
            $('#contenedor_tipo').addClass('d-none');

            if(tipo == 'Formal'){
                $('#titulo_tipo_documental').html('CERTIFICADO DE ESTUDIO Y DIPLOMA DE EDUCACIÓN FORMAL');
                $('.campo_certificado_estudio').removeClass('d-none');
                $('.campo_certificado_estudio.estudio_no_formal').addClass('d-none');

                $('#institucion').addClass('cursor_pointer');
                $('#institucion').prop('readonly',true);
                $('#institucion').prop('placeholder','Seleccione');
                $('#institucion').parent().children('label').html('Institución (*)');
            }else if(tipo == 'No Formal'){
                $('#titulo_tipo_documental').html('CERTIFICADO DE ESTUDIO Y DIPLOMA DE EDUCACIÓN NO FORMAL');
                $('.campo_certificado_estudio').removeClass('d-none');
                $('.campo_certificado_estudio.estudio_formal').addClass('d-none');

                $('#institucion').removeClass('cursor_pointer');
                $('#institucion').prop('readonly',false);
                $('#institucion').prop('placeholder','');
                $('#institucion').parent().children('label').html('Institución (*)');
            }else{
                $('.campo_certificado_estudio').addClass('d-none');
            }
        })

        $('body').on('change','.check-graduado',function () {
            if($(this).val() == 'si'){
                $('.fechas_estudio_formal').removeClass('d-none');
            }else{
                $('.fechas_estudio_formal').addClass('d-none');
            }
        })

        $('#fecha_inicio').change(function () {
            var fecha_fin = $('#fecha_fin').val();
            if(fecha_fin){
                fecha_fin = new Date(fecha_fin);
                fecha_inicio = new Date($(this).val());
                if(fecha_fin.getTime() <= fecha_inicio.getTime()){
                    abrirMensajesValidacion('contenedor_fecha_inicio',"danger",{'fecha_inicio':['no es posible seleccionar una fecha mayor a la establecida en el campo "fecha fin"']});
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

        $('#fecha_fin').change(function () {
            var fecha_inicio = $('#fecha_inicio').val();
            if(fecha_inicio){
                fecha_inicio = new Date(fecha_inicio);
                fecha_fin = new Date($(this).val());
                if(fecha_fin.getTime() <= fecha_inicio.getTime()){
                    abrirMensajesValidacion('contenedor_fecha_fin',"danger",{'fecha_fin':['no es posible seleccionar una fecha menor o igual a la establecida en el campo "fecha inicio"']});
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

        $('#institucion').click(function () {
            if($('#tipo').val() == 'Formal'){
                if(accion_actual == 'crear') {
                    $('#modal-registrar-tipo-documental').modal('hide');
                }else {
                    $('#modal-editar-documento').modal('hide');
                }
                setTimeout(function () {
                    $('#modal-seleccionar-institucion').modal('show');
                },500);
            }
        })

        $('#tabla_instituciones').bind('institucion_seleccionada',function (e,institucion) {
            var element_institucion = null;
            if(accion_actual == 'crear'){
                element_institucion = $('#modal-registrar-tipo-documental').find('#institucion');
            }else{
                element_institucion = $('#modal-editar-documento').find('#institucion');
            }
            $(element_institucion).val(institucion);
            $(element_institucion).focusin();
            $(element_institucion).focusout();

            $('#modal-seleccionar-institucion').modal('hide');
            setTimeout(function () {
                if(accion_actual == 'crear') {
                    $('#modal-registrar-tipo-documental').modal('show');
                }else{
                    $('#modal-editar-documento').modal('show');
                }
            },500);
        });
    })
</script>