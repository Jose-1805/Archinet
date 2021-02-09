<li class="nav-item {{Request::is('expediente/*') ||  Request::is('expediente')? $class_active_bg:''}}">
    <a class="nav-link mayuscula font-small d-flex align-items-center
        {{Request::is('expediente/*') ||  Request::is('expediente')? $class_active_text:$class_no_active_text}}
            " href="{{url('/expediente')}}">
        <div style="width: 30px;">
            <i class="fas fa-address-card font-large margin-right-10"></i>
        </div>
        Mi Expediente
    </a>
</li>

<li class="nav-item {{Request::is('certificado/*') ||  Request::is('certificado')? $class_active_bg:''}}">
    <a class="nav-link mayuscula font-small d-flex align-items-center
        {{Request::is('certificado/*') ||  Request::is('certificado')? $class_active_text:$class_no_active_text}}
            " href="{{url('/certificado')}}">
        <div style="width: 30px;">
            <i class="fas fa-certificate font-large margin-right-10"></i>
        </div>
        Mis Certificados
    </a>
</li>