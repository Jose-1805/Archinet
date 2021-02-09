var cols = [];
$('#tabla-tipos-documentales').dataTable({
             "bJQueryUI": true,
             "sPaginationType": "full_numbers",
             "bAutoWidth": false,
             "bRetrieve": true,
             //"oLanguage": getOLanguage(),
             "aaSorting": [[ 0, "asc" ]],
             "iDisplayLength": 25,
             "aoColumns": [
             {"sType": "fecha-hora"},
             {"bVisible": false},
             null,
             null,
             null,
             null
             ]

        });

$(function () {
    $('#btn-guardar-nuevo-tipo-documental').click(function () {
        guardarTipoDocumental();
    });

    $('body').on('click','.btn-editar-tipo-documental',function () {
        var id = $(this).data('tipo-documental');

        var params = {_token:$('#general_token').val(),id:id};

        var url = $('#general_url').val()+'/tipo-documental/form';

        abrirBlockUiCargando('Cargando ');

        $.post(url,params)
            .done(function (data) {
                $('#modal-editar-tipo-documental').find('.modal-body').html(data);
                $('#modal-editar-tipo-documental').modal('show');
                cerrarBlockUiCargando();
            })
            .fail(function (jqXHR,status,error) {
                cerrarBlockUiCargando();
                alert('Ocurrió un error inesterado!');
            })
    })

    $('#btn-actualizar-tipo-documental').click(function () {
        $('#modal-editar-tipo-documental').modal('hide');
        setTimeout(function () {
            $('#modal-confirmar-tipo-documental').modal('show');
        },500);
    })

    $('#btn-actualizar-tipo-documental-no').click(function () {
        $('#modal-confirmar-tipo-documental').modal('hide');
        setTimeout(function () {
            $('#modal-editar-tipo-documental').modal('show');
        },500);
    })

    $('#btn-actualizar-tipo-documental-ok').click(function () {
        editarTipoDocumental();
    })
})

function setCols(colums) {
    cols = colums;
}

function guardarTipoDocumental() {
    var params = $('#form-nuevo-tipo-documental').serialize();

    var url = $('#general_url').val()+'/tipo-documental/guardar';

    abrirBlockUiCargando('Guardando ');
    $.post(url,params)
        .done(function (data) {
            cargarTablaTiposDocumentales();
            if(data.success){
                $('#form-nuevo-tipo-documental')[0].reset();

                $('#modal-crear-tipo-documental').modal('hide');

                $('#modal-alert-success').find('.modal-body').eq(0).html('<p>Tipo documental creado con éxito</p>');
                $('#modal-alert-success').modal('show');

            }
            cerrarBlockUiCargando();
        }).fail(function (jqXHR,state,error) {
            cerrarBlockUiCargando();
            abrirMensajesValidacion('form-nuevo-tipo-documental', 'danger', JSON.parse(jqXHR.responseText));
        });
}

function editarTipoDocumental() {
    var params = $('#form-editar-tipo-documental').serialize();

    var url = $('#general_url').val()+'/tipo-documental/editar';

    abrirBlockUiCargando('Guardando ');
    $.post(url,params)
        .done(function (data) {
            cargarTablaTiposDocumentales();
            if(data.success){
                $('#modal-confirmar-tipo-documental').modal('hide');

                $('#modal-alert-success').find('.modal-body').eq(0).html('<p>Tipo documental actualizado con éxito</p>');
                $('#modal-alert-success').modal('show');
            }
            cerrarBlockUiCargando();
        }).fail(function (jqXHR,state,error) {
            $('#modal-confirmar-tipo-documental').modal('hide');
            setTimeout(function () {
                $('#modal-editar-tipo-documental').modal('show');
            },500);
            cerrarBlockUiCargando();
            abrirMensajesValidacion('form-editar-tipo-documental', 'danger', JSON.parse(jqXHR.responseText));
        });
}

function cargarTablaTiposDocumentales() {
    var tabla_tipos_documentales = $('#tabla-tipos-documentales').dataTable({ "destroy": true });
    tabla_tipos_documentales.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-tipos-documentales').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_tipos_documentales = $('#tabla-tipos-documentales').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/tipo-documental/lista",
        columns: cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id','row_'+aData.id);
            setTimeout(function () {
            },300);
        },
    });
}
