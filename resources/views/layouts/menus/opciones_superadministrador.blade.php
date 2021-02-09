<li class="nav-item {{Request::is('expediente/*') ||  Request::is('expediente')? $class_active_bg:''}}">
    <a class="nav-link mayuscula font-small d-flex align-items-center
        {{Request::is('expediente/*') ||  Request::is('expediente')? $class_active_text:$class_no_active_text}}
        " href="{{url('/expediente')}}">
        <div style="width: 30px;">
            <i class="fas fa-address-card font-large margin-right-10"></i>
        </div>
        Expediente
    </a>
</li>
<li class="nav-item {{Request::is('historial_eventos') ||  Request::is('historial_eventos')? $class_active_bg:''}}">
    <a class="nav-link mayuscula font-small d-flex align-items-center
        {{Request::is('historial_eventos/*') ||  Request::is('historial_eventos')? $class_active_text:$class_no_active_text}}
        " href="{{url('/historial_eventos')}}">
        <div style="width: 30px;">
            <i class="fas fa-address-book font-large margin-right-10"></i>
        </div>
        Historial de Eventos
    </a>
</li>


<li class="nav-item {{Request::is('usuario/*') ||  Request::is('usuario')? $class_active_bg:''}}">
    <a class="nav-link mayuscula font-small d-flex align-items-center
        {{Request::is('usuario/*') ||  Request::is('usuario')? $class_active_text:$class_no_active_text}}
        " href="{{url('/usuario')}}">
        <div style="width: 30px;">
            <i class="fas fa-users font-large margin-right-10"></i>
        </div>
        Usuarios
    </a>
</li>

<li class="nav-item {{Request::is('rol/*') ||  Request::is('rol')? $class_active_bg:''}}" href="{{url('/rol')}}">
    <a class=" nav-link mayuscula font-small d-flex align-items-center
        {{Request::is('rol/*') ||  Request::is('rol')? $class_active_text:$class_no_active_text}}
        " href="{{url('/rol')}}">
        <div style="width: 30px;">
            <i class="fas fa-users-cog font-large margin-right-10"></i>
        </div>
        Roles
    </a>
</li>