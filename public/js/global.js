var idioma_tablas = {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    };

$(function () {
    $('#contenido-pagina').css({
        minHeight:(window.innerHeight-120-$('.pie-pagina').eq(0).height())+'px'
    })
    $(window).resize(function () {
        $('#contenido-pagina').css({
            minHeight:(window.innerHeight-120-$('.pie-pagina').eq(0).height())+'px'
        })
    })
    //evita que se cierren las alertas como lo hace bootstrap (quitando la clase de la alert) y oculta con la clase d-none la alerta
    $('body').on('click','.alert .close',function () {
        $(this).parent().addClass('d-none');
    })

    //Cuando se presione enter dentro de un formulario se realiza click sobre el elemento que contenga la clase btn-submit
    $("body").on('keyup','form',function (e) {
        if(e.keyCode == 13 && e.target.nodeName != 'TEXTAREA'){
            $(this).find('.btn-submit').click();
        }
    })

    //CLASES PARA INGRESO DE NUMEROS
    iniciarNumerics();

    inicializarComplementos();

    //evita que se realice el submit de un form
    $('form.no_submit').submit(function (e) {
        e.preventDefault();
    })


    $('body').on('keyup','textarea,input',function() {
        var length = $(this).val().length;
        var maxLength = $(this).prop('maxlength');
        if(maxLength) {
            var length = maxLength - length;
            $(this).parent().children('.count-length').html(length);
            $(this).parent().children('.count-length-no-form-control').html(length);
        }
    });

    $('body').on('focusin','textarea,input',function () {
       var element_count = $(this).parent().children('.count-length');
       if($(element_count).length){
           $('.count-length').addClass('d-none');
           $(element_count).removeClass('d-none');
       }
       var element_count = $(this).parent().children('.count-length-no-form-control');
       if($(element_count).length){
           $('.count-length-no-form-control').addClass('d-none');
           $(element_count).removeClass('d-none');
       }
    });

    $('body').on('focusout','textarea,input',function () {
        $('.count-length').addClass('d-none');
        $('.count-length-no-form-control').addClass('d-none');
    });

    $('.count-length').addClass('d-none');
    $('.count-length-no-form-control').addClass('d-none');



    $('body').on('click','.alert .close', function () {
        $(this).parent().addClass('d-none');
    })

    $('body').on('focus','.input-validado *',function () {
        var parent = $(this).parent();
        var completo = false;
        while (!completo){
            if($(parent).hasClass('input-validado')){
                completo = true;
                $(parent).removeClass('input-validado');
                $(parent).removeClass('input-validado-danger');
                $(parent).find('.contenedor-mensaje-validacion').remove();
            }else{
                parent = $(parent).parent();
                if(!$(parent).length){
                    console.log('Sin resultados');
                    completo = true;
                }
            }
        }
    })

    $('body').on('focusout','.input-validado *',function () {
        var parent = $(this).parent();
        var completo = false;
        while (!completo){
            if($(parent).hasClass('input-validado')){
                completo = true;
                $(parent).removeClass('input-validado');
                $(parent).removeClass('input-validado-danger');
                $(parent).find('.contenedor-mensaje-validacion').remove();
            }else{
                parent = $(parent).parent();
            }
        }
    })
})

/**
 * Funcion para mostrar las alertas del sistema
 * @param id_contenedor => contenedor de las alertas
 * @param tipo => info - success - warning - danger
 * @param data => array con la información
 * @param duracion => duracion en segundos
 * @param id_contenedor_scroll => id del contenedor que posee el scroll que debe quedar en top = 0
 */
function abrirAlerta(id_contenedor,tipo, data, duracion = null,id_contenedor_scroll = false){
    var html = "";
    $.each(data, function(key,value){
        html += "• "+value+"<br/>";
    });
    $("#"+id_contenedor+" .alert").addClass("d-none");
    $("#"+id_contenedor+" .alert-"+tipo+" .mensaje").html(html);
    $("#"+id_contenedor+" .alert-"+tipo).removeClass("d-none");

    if(duracion != null && $.isNumeric(duracion)){
        setTimeout(function () {
            $("#"+id_contenedor+" .alert-"+tipo).addClass("d-none");
        },(duracion*1000));
    }

    if(id_contenedor_scroll != false) {
        //$("#" + id_contenedor_scroll).stop().animate({scrollTop: 0}, '5000', 'swing');
        //$("#" + id_contenedor_scroll).scrollTop(0);
        $('html, body').stop().animate({scrollTop: 0}, '500', 'swing');
    }
}

/**
 * Funcion para mostrar las alertas del sistema
 * @param id_contenedor => contenedor de las alertas
 * @param tipo => info - success - warning - danger
 * @param data => array con la información
 * @param duracion => duracion en segundos
 * @param id_contenedor_scroll => id del contenedor que posee el scroll que debe quedar en top = 0
 */
function abrirMensajesValidacion(id_contenedor,tipo, data){
    $.each(data, function(key,value){
        var html = "";

        var parent = $('#'+id_contenedor).find('#'+key).parent();

        if($(parent).find('.contenedor-mensaje-validacion').length) {

            if($(parent).find('.contenedor-mensaje-validacion').hasClass('text-'+tipo))
                html += $(parent).find('.contenedor-mensaje-validacion').html();
        }


        $.each(value,function (key_,value_) {
            if(value_) {
                if(html.split(value_).length == 1)
                    html += "• " + value_ + "<br/>";
            }
        });

        html = "<div class='contenedor-mensaje-validacion font-small text-"+tipo+"' style=''>"+html+"</div>";
        $(parent).find('.contenedor-mensaje-validacion').remove();
        $(parent).append(html)
        $(parent).addClass('input-validado');
        $(parent).removeClass('input-validado-success');
        $(parent).removeClass('input-validado-danger');
        $(parent).addClass('input-validado-'+tipo);
    });

    //$('html, body').stop().animate({scrollTop: 0}, '500', 'swing');
}

/**
 * Abre dialog de bloqueo de pantalla
 * Debe incluir framework de diseñño MATERIALIZECSS o las clases de color contenidas en él
 *
 * @param mensaje => mensaje a mostrar, si se pasa el valor undefined muestra el mensaje por defecto
 * @param load => si debe mostrar icono de carga o no
 */
function abrirBlockUiCargando(mensaje = "Cargando",load = true) {
    var html = '<h4 class="white-text mensaje-load"><img src="'+$('#general_url').val()+'/imagenes/logos/logoarchinet.png" style="width: 100px !important;" /><br><p>'+mensaje;
    if(load)
        html += ' <i class="fas fa-spin fa-spinner white-text"></i>';
    html += '</p></h4>';
    $.blockUI({ message: html });
}

function cerrarBlockUiCargando() {
    $.unblockUI();
}

function abrirBlockUiElemento(elemento, mensaje = "Cargando",load = true) {
    var html = '<h4 class="white-text mensaje-load">'+mensaje;
    if(load)
        html += ' <i class="fas fa-spin fa-spinner white-text"></i>';
    html += '</h4>';
    $(elemento).block({ message: html });
}

function cerrarBlockUiElemento(elemento) {
    $(elemento).unblock();
}

/**
 * Inicializa complementos javascript para la funcionalidad general del sistema
 */
function inicializarComplementos() {
    //inicialización de tooltips
    $('[data-toggle="tooltip"]').tooltip();
    if($('.datepicker').length) {
        $('.datepicker').datepicker({
            allowPastDates: true,
            formatDate: function (objectDate) {
                return objectDate.getFullYear() + '/' + (objectDate.getMonth() + 1) + '/' + objectDate.getDate();
            }
        });
    }
}

function agregarDivisionesDivs(id,cantidad_x_small,cantidad_small,cantidad_medium,cantidad_large) {
    $('#'+id+' .item_division_div').each(function (i,el) {
        if(cantidad_x_small > 1){
            if((i+1)%cantidad_x_small == 0){
                var html = '<div class="row d-sm-none d-md-none d-lg-none"></div>';
                $(el).after(html);
            }
        }
        if(cantidad_small > 1){
            if((i+1)%cantidad_small == 0){
                var html = '<div class="row d-none d-md-none d-lg-none"></div>';
                $(el).after(html);
            }
        }
        if(cantidad_medium > 1){
            if((i+1)%cantidad_medium == 0){
                var html = '<div class="row d-sm-none d-none d-lg-none"></div>';
                $(el).after(html);
            }
        }
        if(cantidad_large > 1){
            if((i+1)%cantidad_large == 0){
                var html = '<div class="row d-sm-none d-md-none d-none"></div>';
                $(el).after(html);
            }
        }
    })
}

function quitarTildes(cadena) {
    return cadena.replace(/([àáâãäå])|([ç])|([èéêë])|([ìíîï])|([ñ])|([òóôõöø])|([ß])|([ùúûü])|([ÿ])|([æ])/g, function(str,a,c,e,i,n,o,s,u,y,ae) { if(a) return 'a'; else if(c) return 'c'; else if(e) return 'e'; else if(i) return 'i'; else if(n) return 'n'; else if(o) return 'o'; else if(s) return 's'; else if(u) return 'u'; else if(y) return 'y'; else if(ae) return 'ae'; })
}

//manejo de inputs con clases para ingreso de numeros
function iniciarNumerics() {
    $(".num-int-positivo").numericInput({ allowNegative: false,allowFloat: false});
    $(".num-int").numericInput({ allowNegative: true,allowFloat: false});
    $(".num-float-positivo").numericInput({ allowNegative: false,allowFloat: true});
    $(".num-float").numericInput({ allowNegative: true,allowFloat: true});
}