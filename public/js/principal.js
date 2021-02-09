/*

 @if(\Illuminate\Support\Facades\Auth::guest())
 @include('layouts.menus.no_autenticado')
 @else
 @include('layouts.menus.autenticado')
 @endif
*/

$(function () {
    evaluarDisplayMenu();
    $('.btn-toggle-menu').click(function () {
       if($('#menu-1').hasClass('d-none')){
           $('#menu-1').removeClass('d-none');
           $('#menu-2').addClass('d-none');
       }else{
           $('#menu-1').addClass('d-none');
           $('#menu-2').removeClass('d-none');
       }
    });

    $(window).resize(function () {
        evaluarDisplayMenu();
    })
})


//se oculta el menu con opciones
//si la pantalla es tamaño movil
function evaluarDisplayMenu() {
    if(window.innerWidth < 768){
        $('#menu-1').addClass('d-none');
        $('#menu-2').removeClass('d-none');
    }else{
        $('#menu-1').removeClass('d-none');
        $('#menu-2').addClass('d-none');
    }
}
