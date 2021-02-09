var usuario = null;
var cols = [];
var modalDetalles = $('#detalles');

$(function () {


    $('#actividad,#modulo').change(function(){
        cargarTablaEventos();
    });
});

function setCols(colums) {
    cols = colums;
}

function abrirModal(e){
    $('#titulo_modulo').html(e.dataset.modulo);
    $('#titulo_evento').html("<strong>Evento: </strong>"+e.dataset.evento);
    var obj = JSON.parse(e.dataset.new.replace(/&quot;/g,'"'));
    mostrarDatos(obj);
    modalDetalles.modal('show');
}

function mostrarDatos(array) {
    var datos = "";
    var datosPermi = "nombre_archivo, nombres,apellidos, identificacion,tipo_identificacion, celular, email,estado_civil,correo_opcional,direccion,fecha_nacimiento,validado";
    var i = 0;
    array.forEach(function(element) {
        if(datosPermi.indexOf(element.campo) >= 0){
            datos +=

                "<tr>\n" +
                    "<th scope=\"row\">"+(++i)+"</th>\n" +
                    "<td>"+element.campo+"</td>\n" +
                    "<td>"+element.anterior+"</td>\n" +
                    "<td>"+element.nuevo+"</td>\n" +
                "</tr>";
        }
    });

    modalDetalles.find('#informacion_evento').html(datos);

}


function cargarTablaEventos() {
    var tabla_eventos = $('#tabla-eventos').dataTable({ "destroy": true });
    tabla_eventos.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-eventos').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_funcionarios = $('#tabla-eventos').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: {
            url:$("#general_url").val() + "/historial_eventos/listaEventos",
            data: {
                modulos: $('#modulo').val(),
                actividades: $('#actividad').val(),
            }

         },
        columns: cols
    });
}

function exportarLog() {
    var modulo = $('#modulo').val()?$('#modulo').val():'undefined';
    var actividad = $('#actividad').val()?$('#actividad').val():'undefined';
    var url = $('#general_url').val()+'/historial_eventos/exportar/'+modulo+'/'+actividad;
    window,location.href = url;
}