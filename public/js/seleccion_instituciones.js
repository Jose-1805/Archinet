var datos_tabla = {};
var columns_tabla = {};
var table_datatable = null;

var select_preeescolar = '$select=nombreestablecimiento,codigoestablecimiento,calendario,correo_electronico,telefono,nombredepartamento,nombremunicipio';

var columns_preescolar = [
    {title:'Seleccionar',render: function (data, type, row) {
        return '<a class="btn btn-primary btn-sm btn-seleccionar-institucion" data-institucion="'+row.nombreestablecimiento+'"><i class="fas fa-check-square fa-2x"></i></a>';
    }},
    {title:'Nombre Establecimiento',data:'nombreestablecimiento'},
    {title:'Còdigo Establecimiento',data:'codigoestablecimiento'},
    {title:'Calendario',data:'calendario'},
    {title:'Correo Electrónico',data:'correo_electronico'},
    {title:'teléfono',data:'telefono'},
    {title:'Departamento',data:'nombredepartamento'},
    {title:'Municipio',data:'nombremunicipio'},
];

var select_superior = '$select=nombreinstitucion,codigoinsitucion,nitinstitucion,tipoinstitucion,nombredeparamento,nombremunicipio';
var columns_superior = [
    {title:'Seleccionar',render: function (data, type, row) {
        return '<a class="btn btn-primary btn-sm btn-seleccionar-institucion" data-institucion="'+row.nombreinstitucion+'"><i class="fas fa-check-square fa-2x"></i></a>';
    }},
    {title:'Nombre Instituciòn',data:'nombreinstitucion'},
    {title:'Código Insitución',data:'codigoinsitucion'},
    {title:'Nit Institución',data:'nitinstitucion'},
    {title:'Tipo Institución',data:'tipoinstitucion'},
    {title:'Deparamento',data:'nombredeparamento'},
    {title:'Municipio',data:'nombremunicipio'},
];

var select_trabajo_desarrollo = '$select=nombreinstitucion,codigoinstitucion,nitinstitucion,telefonoprincipal,nombredepartamento,nombremunicipio';
var columns_trabajo_desarrollo = [
    {title:'Seleccionar',render: function (data, type, row) {
        return '<a class="btn btn-primary btn-sm btn-seleccionar-institucion" data-institucion="'+row.nombreinstitucion+'"><i class="fas fa-check-square fa-2x"></i></a>';
    }},
    {title:'Nombre Instituciòn',data:'nombreinstitucion'},
    {title:'Código Insitución',data:'codigoinsitucion'},
    {title:'Nit Institución',data:'nitinstitucion'},
    {title:'Teléfono Principal',data:'telefonoprincipal'},
    {title:'Deparamento',data:'nombredeparamento'},
    {title:'Municipio',data:'nombremunicipio'},
];

$(function () {
    $('body').on('change','#tipo_institucion',function () {
        $('.establecimientos_preescolar_primaria').addClass('d-none');
        $('.instituciones_superior').addClass('d-none');
        $('.instituciones_trabajo_desarrollo_humano').addClass('d-none');

        //ESTABLECIMIENTOS EDUCATIVOS DE PREESCOLAR, BÁSICA
        if($(this).val() == 'https://www.datos.gov.co/resource/xax6-k7eu.json'){
            $('.establecimientos_preescolar_primaria').removeClass('d-none');
        }
        //INSTITUCIONES DE EDUCACIÓN SUPERIOR
        else if($(this).val() == 'https://www.datos.gov.co/resource/wmk4-aavp.json'){
            $('.instituciones_superior').removeClass('d-none');
        }
        //INSTITUCIONES DE EDUCACIÓN PARA EL TRABAJO Y EL DESARROLLO HUMANO
        else if($(this).val() == 'https://www.datos.gov.co/resource/9xq7-dghc.json'){
            $('.instituciones_trabajo_desarrollo_humano').removeClass('d-none');
        }
    });

    $('#tipo_institucion').change();

    $('body').on('click','.btn-seleccionar-institucion',function (e) {
        var nombre_institucion = $(this).data('institucion');
        $('#tabla_instituciones').trigger('institucion_seleccionada',[nombre_institucion]);
    });
});

function buscarInstituciones() {
    var url = $('#tipo_institucion').val();
    var params = "$where=";
    var select = '';

    if($('#nombredepartamento').val()){
        if(url == 'https://www.datos.gov.co/resource/wmk4-aavp.json'){
            params += "nombredeparamento like '%25"+$('#nombredepartamento').val().toUpperCase()+"%25'";
        }else{
            params += "nombredepartamento like '%25"+$('#nombredepartamento').val().toUpperCase()+"%25'";
        }
    }

    if($('#nombremunicipio').val()){
        if(params != "$where="){
            params += " AND ";
        }
        params += "nombremunicipio like '%25"+$('#nombremunicipio').val().toUpperCase()+"%25'";
    }

    //ESTABLECIMIENTOS EDUCATIVOS DE PREESCOLAR, BÁSICA
    if(url == 'https://www.datos.gov.co/resource/xax6-k7eu.json'){
        select = select_preeescolar;
        columns_tabla = columns_preescolar;
        if($('#nombreestablecimiento').val()){
            if(params != "$where="){
                params += " AND ";
            }
            params += "nombreestablecimiento like '%25"+$('#nombreestablecimiento').val().toUpperCase()+"%25'";
        }

        if($('#codigoestablecimiento').val()){
            if(params != "$where="){
                params += " AND ";
            }
            params += "codigoestablecimiento = "+$('#codigoestablecimiento').val();
        }

        if($('#calendario').val()){
            if(params != "$where="){
                params += " AND ";
            }
            params += "calendario like '%25"+$('#calendario').val().toUpperCase()+"%25'";
        }
    }
    //INSTITUCIONES DE EDUCACIÓN SUPERIOR
    else if(url == 'https://www.datos.gov.co/resource/wmk4-aavp.json'){
        select = select_superior;
        columns_tabla = columns_superior;
        if($('#nombreinstitucion').val()){
            if(params != "$where="){
                params += " AND ";
            }
            params += "nombreinstitucion like '%25"+$('#nombreinstitucion').val().toUpperCase()+"%25'";
        }

        if($('#codigoinstitucion').val()){
            if(params != "$where="){
                params += " AND ";
            }
            params += "codigoinsitucion = "+$('#codigoinstitucion').val();
        }

        if($('#nitinstitucion').val()){
            if(params != "$where="){
                params += " AND ";
            }
            params += "nitinstitucion like '%25"+$('#nitinstitucion').val().toUpperCase()+"%25'";
        }
    }
    //INSTITUCIONES DE EDUCACIÓN PARA EL TRABAJO Y EL DESARROLLO HUMANO
    else if(url == 'https://www.datos.gov.co/resource/9xq7-dghc.json'){
        select = select_trabajo_desarrollo;
        columns_tabla = columns_trabajo_desarrollo;
        if($('#nombreinstitucion').val()){
            if(params != "$where="){
                params += " AND ";
            }
            params += "nombreinstitucion like '%25"+$('#nombreinstitucion').val().toUpperCase()+"%25'";
        }

        if($('#codigoinstitucion').val()){
            if(params != "$where="){
                params += " AND ";
            }
            params += "codigoinstitucion = "+$('#codigoinstitucion').val();
        }

        if($('#nitinstitucion').val()){
            if(params != "$where="){
                params += " AND ";
            }
            params += "nitinstitucion like '%25"+$('#nitinstitucion').val().toUpperCase()+"%25'";
        }
    }

    if(params != '$where=')url += '?'+params+'&'+select;
    else url += '?'+select;

    $.get(url)
        .done(function (data) {
            console.log(data);
            datos_tabla = data;
            cargarTablaInstituciones();
        })
}

function cargarTablaInstituciones() {
    table_datatable = $('#tabla_instituciones').DataTable( {
        destroy: true,
        data: datos_tabla,
        columns: columns_tabla
    } );
}