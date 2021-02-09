var documento = null;
var cols = null;
//identifica cuando se esta creando o editando un documento
var accion_actual = 'crear';
$(function () {
    $('#btn-seleccion-tipo-documental').click(function () {
        if($('#seleccion_tipo_documental').val()) {
            accion_actual = 'crear';

            var params = $('#form-seleccion-tipo-documental').serialize();
            var url = $('#general_url').val() + '/expediente/form-tipo-documental';

            $('#modal-seleccion-tipo-documental').modal('hide');
            abrirBlockUiCargando('Cargando');

            $('#modal-editar-documento').find('.modal-body').html('');
            $.post(url, params)
                .done(function (data) {
                    $('#contenedor-datos-tipo-documental').html(data);
                    setTimeout(function () {
                        cerrarBlockUiCargando();
                        $('#modal-registrar-tipo-documental').modal('show');
                    },500);
                });
        }
    });

    $('#btn-guardar-tipo-documental').click(function () {
        guardarTipoDocumental();
    });

    $("#vista").change(function(){
        if(parseInt($(this).val()) === 2){
            $("#contenedor-vista-historial-laboral").hide();
            $("#contenedor-vista-historial-laboral-cronologico").show();
            cargarTablaTiposDocumentales();
        } else {
            $("#contenedor-vista-historial-laboral").show();
            $("#contenedor-vista-historial-laboral-cronologico").hide();
        }
    });

    $('body').on('click','.btn-ver-documento',function () {
        var id = $(this).data('documento');
        var params = {_token:$('#general_token').val(),id:id};
        var url = $('#general_url').val()+'/expediente/datos-documento';
        abrirBlockUiCargando();

        $.post(url,params)
            .done(function (data) {
                $('#modal-ver-documento').find('.modal-body').html(data);
                $('#modal-ver-documento').modal('show');
                cerrarBlockUiCargando();
            })
            .fail(function (jqXHR,error,state) {
                alert('Ocurrio un error inesperado, intente nuevamente');
                cerrarBlockUiCargando();
                window.location.reload(true);
            });
    });

    $('body').on('click','#btn-validar-editar-documento',function () {
        $('#modal-editar-documento').modal('hide');
        setTimeout(function () {
            $('#modal-validar-editar-documento').modal('show');
        },500);
    });

    $('body').on('click','#btn-no-editar-documento',function () {
        $('#modal-validar-editar-documento').modal('hide');
        setTimeout(function () {
            $('#modal-editar-documento').modal('show');
        },500);
    });

    $('#btn-editar-documento').click(function () {
        editarDocumento();
    });

    $('body').on('click','.btn-editar-documento',function () {
        accion_actual = 'editar';
        var id = $(this).data('documento');
        var params = {_token:$('#general_token').val(),id:id};
        var url = $('#general_url').val()+'/expediente/form-editar-documento';
        $('#contenedor-datos-tipo-documental').html('');

        abrirBlockUiCargando();

        $.post(url,params)
            .done(function (data) {
                $('#modal-editar-documento').find('.modal-body').html(data);
                $('#modal-editar-documento').modal('show');
                cerrarBlockUiCargando();
            })
            .fail(function (jqXHR,error,state) {
                alert('Ocurrio un error inesperado, intente nuevamente');
                cerrarBlockUiCargando();
                //window.location.reload(true);
            });
    });

    $('#cerrar_seleccionar_instituciones').click(function () {
        $('#modal-seleccionar-institucion').modal('hide');

        setTimeout(function () {
            if(accion_actual == 'editar'){
                $('#modal-editar-documento').modal('show');
            }else{
                $('#modal-registrar-tipo-documental').modal('show');
            }
        }, 500);
    });
});

function guardarTipoDocumental() {
    var params = new FormData(document.getElementById('form-registrar-tipo-documental'));
    var url = $("#general_url").val()+"/expediente/guardar-tipo-documental";

    abrirBlockUiCargando('Guardando ');

    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            $('#contenedor-datos-tipo-documental').html('');
            $('#modal-registrar-tipo-documental').modal('hide');
            setTimeout(function () {
                $('#modal-alert-success').find('.modal-body').eq(0).html('<p>Registro exitoso</p>');
                $('#modal-alert-success').modal('show');
                cerrarBlockUiCargando();
            },500);
            cargarTablaTiposDocumentales();
        },
        error: function (jqXHR, error, state) {
            abrirMensajesValidacion("form-registrar-tipo-documental", "danger", JSON.parse(jqXHR.responseText));
            cerrarBlockUiCargando();
        }
    });
}

function editarDocumento() {
    var params = new FormData(document.getElementById('form-editar-documento'));
    var url = $("#general_url").val()+"/expediente/editar-documento";

    abrirBlockUiCargando('Guardando ');

    $.ajax({
        url: url,
        data: params,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            $('#modal-registrar-tipo-documental').find('.modal-body').html('');
            $('#modal-validar-editar-documento').modal('hide');
            setTimeout(function () {
                $('#modal-alert-success').find('.modal-body').eq(0).html('<p>Documento actualizado</p>');
                $('#modal-alert-success').modal('show');
                cerrarBlockUiCargando();
            },500);
            cargarTablaTiposDocumentales();
        },
        error: function (jqXHR, error, state) {
            $('#modal-validar-editar-documento').modal('hide');
            setTimeout(function () {
                $('#modal-editar-documento').modal('show');
                abrirMensajesValidacion("form-editar-documento", "danger", JSON.parse(jqXHR.responseText));
                cerrarBlockUiCargando();
            },500);
        }
    });
}
function setCols(colums) {
    cols = colums;
}
function cargarTablaTiposDocumentales() {

    var tablatiposdocumentales = $('#tabla-tipos-documentales').dataTable({ "destroy": true });
    tablatiposdocumentales.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-tipos-documentales').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    });

    tablatiposdocumentales = $('#tabla-tipos-documentales').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,

        ajax: {
            url: $("#general_url").val()+"/expediente/listatiposdocumentales",
            data: {
                seccionId: seccionId,
                userId: userId
            }
        },
        columns: cols,
        /*fnRowCallback: function (nRow, aData, iDisplayIndex) {
         console.log(aData);
         $(nRow).attr('url', "http://localhost:8000/expediente"+aData.id);
         $(nRow).click(function (){
         var url = $(this).attr("url");
         alert(url);
         //window.location.href = url;
         });
         $(nRow).attr('id','row_'+aData.id);
         setTimeout(function () {
         },300);
         },*/
    });
}
function validarDocumento() {
    if(documento){
        var url = $('#general_url').val()+'/expediente/validar-documento/'+documento;
        var params = {_token:$('#general_token').val()};
        abrirBlockUiCargando('Validando documento');
        $.post(url,params)
            .done(function (data) {
                cerrarBlockUiCargando();
            });
    }
}