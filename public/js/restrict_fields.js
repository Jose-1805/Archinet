var key_codes = [
    8, //Borrar
    9,//TAB
    46, //suprimir
    35, //fin
    36, //inicio
    37,//izquierda
    39,//derecha
    13];//enter
var state_alphanumeric = true;
var state_alphanumeric_space = true;
var state_alphabetical = true;
var state_alphabetical_space = true;
var state_numeric = true;
var state_mail_sena = true;
var state_mail = true;
var state_required_field = true;
var state_valid_lenght = true;

$(function () {
    //no se permiten caracteres de espacio al inicio de un input
    //ni mas de uno al final
    $('body').on('keyup','input, textarea', function () {
        var parar = false;

        while (!parar){
            if($(this).val().charAt(0) == ' '){
                $(this).val($(this).val().trim());
            }else{
                parar = true;
            }
        }

        parar = false;
        //si tiene mas de un espacio al final
        var str = '';
        while (!parar){
            str = $(this).val();
            if(str.charAt(str.length-1) == ' ' && str.charAt(str.length-2) == ' '){
                $(this).val($(this).val().trim());
            }else{
                parar = true;
            }
        }
    });

    $('body').on('keydown','.alphanumeric',function (e) {
        var retorno = false;
        if(parseInt(key_codes.indexOf(e.keyCode))>=0) {
            retorno = true;
        }

        var regex = new RegExp(/[A-Za-z0-9ñ]/);
        //var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        var str = e.originalEvent.key;
        if (regex.test(str) && str !== 'Unidentified') {
            retorno = true;
        }

        if($(this).hasClass('valid-restrict-field')){
            if(retorno){
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
                state_alphanumeric = true;
                startMsjValidation(true,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"success",data);
            }else {
                var id = $(this).attr('id');
                var data = '{"' + id + '":["Sólo se permiten caracteres alfanuméricos (a-z/A-Z 0-9)"]}';
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
                state_alphanumeric = false;
                startMsjValidation(false,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"danger",data);
            }
        }
        if(retorno)return true;

        e.preventDefault();
        return false;

    });
    $('body').on('keydown','.alphanumeric_space',function (e) {
        var retorno = false;
        if(parseInt(key_codes.indexOf(e.keyCode))>=0) {
            retorno = true;
        }

        var regex = new RegExp(/[A-Za-z0-9 ñ]/);
        //var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        var str = e.originalEvent.key;
        if (regex.test(str) && str !== 'Unidentified') {
            retorno = true;
        }

        if($(this).hasClass('valid-restrict-field')){
            if(retorno){
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

                state_alphanumeric_space = true;
                startMsjValidation(true,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"success",data);
            }else {
                var id = $(this).attr('id');
                var data = '{"' + id + '":["Sólo se permiten caracteres alfanuméricos (a-z/A-Z 0-9)"]}';
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
                state_alphanumeric_space = false;
                startMsjValidation(false,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"danger",data);
            }
        }
        if(retorno)return true;

        e.preventDefault();
        return false;
    });

    $('body').on('keydown','.alphabetical',function (e) {
        var retorno = false;
        if(parseInt(key_codes.indexOf(e.keyCode))>=0) {
            retorno = true;
        }

        var regex = new RegExp(/[A-Za-zñ]/);
        //var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        var str = e.originalEvent.key;
        if (regex.test(str) && str !== 'Unidentified') {
            retorno = true;
        }

        if($(this).hasClass('valid-restrict-field')){
            if(retorno){
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
                state_alphabetical = true;
                startMsjValidation(true,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"success",data);
            }else {
                var id = $(this).attr('id');
                var data = '{"' + id + '":["Sólo se permiten caracteres alfabéticos (a-z/A-Z)"]}';
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
                state_alphabetical = false;
                startMsjValidation(false,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"danger",data);
            }
        }
        if(retorno)return true;

        e.preventDefault();
        return false;

    });
    $('body').on('keydown','.alphabetical_space',function (e) {
        var retorno = false;
        if(parseInt(key_codes.indexOf(e.keyCode))>=0) {
            retorno = true;
        }

        var regex = new RegExp(/[A-Za-z ñ]/);
        //var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        var str = e.originalEvent.key;

        //alert(str);
        if (regex.test(str) && str !== 'Unidentified') {
            retorno = true;
        }

        if($(this).hasClass('valid-restrict-field')){
            if(retorno){
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
                state_alphabetical_space = true;
                startMsjValidation(true,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"success",data);
            }else {
                var id = $(this).attr('id');
                var data = '{"' + id + '":["Sólo se permiten caracteres alfabéticos (a-z/A-Z)"]}';
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
                state_alphabetical_space = false;
                startMsjValidation(false,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"danger",data);
            }
        }
        if(retorno)return true;

        e.preventDefault();
        return false;

    });
    $('body').on('keydown','.numeric',function (e) {
        var retorno = false;
        if(parseInt(key_codes.indexOf(e.keyCode))>=0) {
            retorno = true;
        }

        var regex = new RegExp(/[0-9]/);
        //var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        var str = e.originalEvent.key;
        if (regex.test(str) && str !== 'Unidentified') {
            retorno = true;
        }

        if($(this).hasClass('valid-restrict-field')){
            if(retorno){
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
                state_numeric = true;
                startMsjValidation(true,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"success",data);
            }else {
                var id = $(this).attr('id');
                var data = '{"' + id + '":["Sólo se permiten caracteres numéricos (0-9)"]}';
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
                state_numeric = false;
                startMsjValidation(false,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"danger",data);
            }
        }

        if(retorno)return retorno

        e.preventDefault();
        return false;
    });
    $('body').on('paste','.no-paste',function (e) {
        e.preventDefault();
    });
    $('body').on('keydown','.mail_sena',function (e) {
        var retorno = false;
        if(parseInt(key_codes.indexOf(e.keyCode))>=0) {
            retorno = true;
        }

        var regex = new RegExp(/[A-Za-z.@_-]/);
        //var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        var str = e.originalEvent.key;
        if (regex.test(str) && str !== 'Unidentified') {
            retorno = true;
        }

        if($(this).hasClass('valid-restrict-field')){
            if(retorno){
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
                state_mail_sena = true;
                startMsjValidation(true,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"success",data);
            }else {
                var id = $(this).attr('id');
                var data = '{"' + id + '":["Dirección de correo no valida recuerde que debe ser una cuenta de correo institucional SENA"]}';
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
                state_mail_sena = false;
                startMsjValidation(false,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"danger",data);
            }
        }
        if(retorno)return true;

        e.preventDefault();
        return false;
    });

    $('body').on('keyup','.mail_sena',function (e) {
        var correo = $(this).val();
        var data = correo.split('@');
        if(data.length == 2){
            if(data[1] == 'sena.edu.co'){
                var id = $(this).attr('id');
                var data_ = '{"' + id + '":[""]}';
                data_ = JSON.parse(data_);
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
                state_mail_sena = true;
                startMsjValidation(true,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"success",data_);
            }else{
                var id = $(this).attr('id');
                var data_ = '{"' + id + '":["Dirección de correo no valida recuerde que debe ser una cuenta de correo institucional SENA"]}';
                data_ = JSON.parse(data_);
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

                state_mail_sena = false;
                startMsjValidation(false,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"danger",data_);
            }
        }else {
            var id = $(this).attr('id');
            var data_ = '{"' + id + '":["Dirección de correo no valida recuerde que debe ser una cuenta de correo institucional SENA"]}';
            data_ = JSON.parse(data_);
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

            state_mail_sena = false;
            startMsjValidation(false,data,id_contenedor);
            //abrirMensajesValidacion(id_contenedor,"danger",data_);
        }
    });

    $('body').on('keyup','.mail',function (e) {
        var correo = $(this).val();
        var data = correo.split('@');
        if(data.length == 2){
                var id = $(this).attr('id');
                var data_ = '{"' + id + '":[""]}';
                data_ = JSON.parse(data_);
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

                state_mail = true;
                startMsjValidation(true,data_,id_contenedor);
                //abrirMensajesValidacion(id_contenedor,"success",data_);
        }else {
            var id = $(this).attr('id');
            var data_ = '{"' + id + '":["Dirección de correo no válida"]}';
            data_ = JSON.parse(data_);
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
            abrirMensajesValidacion(id_contenedor,"danger",data_);
        }
    });

    $('body').on('focusout','.required_field',function (e) {

        if(!$(this).val() && $(this).attr('id')){
            if($(this).data('required')){
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
                var data = '{"' + $(this).attr('id') + '":["'+$(this).data('required')+'"]}';
                abrirMensajesValidacion(id_contenedor,"danger",JSON.parse(data));
            }
        }
    })

    $('body').on('keydown','.valid_lenght',function (e) {
        var cantidad = parseInt($(this).val().length);
        //si sin las teclas de borrar
        if(e.keyCode == 8 || e.keyCode == 46)cantidad -= 2;

        //console.log('Cantidad: '+cantidad);

        //if(e.keyCode == 32)
        var max = $(this).prop('maxlength');
        var min = $(this).data('min-length');
        //console.log(min+' '+max+' '+cantidad);
        var alerta = false;
        var mensaje = '';
        if(cantidad >= max){
            alerta = true;
            mensaje = 'Este campo no permite más de '+max+' caracteres';
        }

        if(cantidad+1 < min){
            alerta = true;
            mensaje = 'El campo '+$(this).data('field')+' debe contener al menos '+min+' caracteres';
        }

        if(cantidad == min && min == max)alerta = true;

        if($(this).attr('id')){
            if(alerta) {
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
                var data = '{"' + $(this).attr('id') + '":["' + mensaje + '"]}';
                state_valid_lenght = false;
                startMsjValidation(false,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor, "danger", JSON.parse(data));
            }else {
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
                state_valid_lenght = true;
                startMsjValidation(true,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor, "success", data);
            }
        }
    })

    $('body').on('keyup','.valid_lenght',function (e) {
        var cantidad = parseInt($(this).val().trim().length);

        //console.log('Cantidad: '+cantidad);

        //if(e.keyCode == 32)
        var max = $(this).prop('maxlength');
        var min = $(this).data('min-length');
        //console.log(min+' '+max+' '+cantidad);
        var alerta = false;
        var mensaje = '';
        if(cantidad > max){
            alerta = true;
            mensaje = 'Este campo no permite más de '+max+' caracteres';
        }

        if(cantidad < min){
            alerta = true;
            mensaje = 'El campo '+$(this).data('field')+' debe contener al menos '+min+' caracteres';
        }

        if(cantidad == min && min == max)alerta = false;

        if($(this).attr('id')){
            if(alerta) {
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
                var data = '{"' + $(this).attr('id') + '":["' + mensaje + '"]}';
                state_valid_lenght = false;
                startMsjValidation(false,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor, "danger", JSON.parse(data));
            }else {
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
                state_valid_lenght = true;
                startMsjValidation(true,data,id_contenedor);
                //abrirMensajesValidacion(id_contenedor, "success", data);
            }
        }
    })

    $('body').on('focusin','.alphanumeric,.alphanumeric_space,.alphabetical,.alphabetical_space,.numeric,.mail_sena,.mail,.valid_lenght',function (e) {
        restartStates();
    })

    $('body').on('change','.valid_select',function () {
        if($(this).val()){
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
            startMsjValidation(true,data,id_contenedor);
            $(this).blur();
        }
    })
})

function restartStates() {
    state_alphanumeric = true;
    state_alphanumeric_space = true;
    state_alphabetical = true;
    state_alphabetical_space = true;
    state_numeric = true;
    state_mail_sena = true;
    state_mail = true;
    state_required_field = true;
    state_valid_lenght = true;
}

function startMsjValidation(state,data,id_contenedor) {
    if(state){
        if(allStatesOk()) {
            if (typeof data == 'string') {
                data = JSON.parse(data);
            }
            abrirMensajesValidacion(id_contenedor, "success", data);
        }
    }else{
        if(typeof data == 'string'){
            data = JSON.parse(data);
        }
        abrirMensajesValidacion(id_contenedor,"danger",data);
    }
}

function allStatesOk() {
    if(
        state_alphanumeric == true &&
        state_alphanumeric_space == true &&
        state_alphabetical == true &&
        state_alphabetical_space == true &&
        state_numeric == true &&
        state_mail_sena == true &&
        state_mail == true &&
        state_required_field == true &&
        state_valid_lenght == true
    )
        return true;

    return false;
}