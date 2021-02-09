var usuario = null;
var cols = [];

$(function () {
    $("#inputFile").val('');

    $("#importar_funcionarios").click(function (e) {
        e.preventDefault();
        $("#inputFile").click();
    });

    $("#inputFile").change(function (e) {
        if(e.target.value.trim() !== ""){
            abrirBlockUiCargando('Importando archivo...');
            $("#frmImportar").submit();
        }
    });
})

$('#tabla-expediente').dataTable({
             "bJQueryUI": true,
             "sPaginationType": "full_numbers",
             "bAutoWidth": false,
             "bRetrieve": true,
             "oLanguage": getOLanguage(),
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

function setCols(colums) {
    cols = colums;
}

function cargarTablaFuncionarios() {
    var tabla_funcionarios = $('#tabla-expediente').dataTable({ "destroy": true });
    tabla_funcionarios.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-expediente').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_funcionarios = $('#tabla-expediente').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/expediente/lista",
        columns: cols
    });
}