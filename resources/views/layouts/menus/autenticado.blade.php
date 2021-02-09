@php($opciones = isset($opciones)?$opciones:true)
<nav class="row">
    <div class="col-12 padding-top-none">
        <div class="col-12 perfiladmin padding-top-none">
            <div class="row">
                <div class="col-12 padding-bottom-10 padding-top-none">

                    <div class="row d-none d-md-inline">
                        <div class="col-12 padding-top-none padding-bottom-none" style="margin-bottom: -15px;">
                            <i class="white-text fas fa-user-circle fa-4x"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-9 padding-bottom-none">
                            <h6 class="white-text d-flex align-items-center">

                                <i class="fas fa-user-circle margin-right-5 d-inline d-md-none"></i>

                                <span class="text-left">{{Auth::user()->fullName()}}</span>
                            </h6>
                        </div>
                        <div class="col-3 padding-bottom-none">
                            <a class="right btn-toggle-menu white-text margin-left-5 d-inline d-md-none" href="#!">
                                <i class="fas fa-bars"></i>
                            </a>
                            <a class="white-text right" id="link-configuracion" href="{{url('/configuracion')}}"><i class="fas fa-cogs"></i></a>
                        </div>
                        <div class="col-12 text-left padding-top-none" style="">
                            <i class="white-text font-small font-weight-600">{{session('rol')->nombre}}</i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if($opciones)
        <div class="col-12 padding-top-none">
        <ul class="nav flex-column padding-top-2">
            @php
                $class_active_bg = 'unique-color font-weight-bold';
                $class_active_text = 'white-text';
                $class_no_active_text = 'teal-text';
            @endphp
            @if(session('rol')->superadministrador == "si")
                @include('layouts.menus.opciones_superadministrador',['class_active_bg'=>$class_active_bg, 'class_active_text'=>$class_active_text, 'class_no_active_text'=>$class_no_active_text])
            @elseif(session('rol')->funcionario == "si")
                @include('layouts.menus.opciones_funcionario',['class_active_bg'=>$class_active_bg, 'class_active_text'=>$class_active_text, 'class_no_active_text'=>$class_no_active_text])
            @else
                @include('layouts.menus.opciones_user',['class_active_bg'=>$class_active_bg, 'class_active_text'=>$class_active_text, 'class_no_active_text'=>$class_no_active_text])
            @endif

            <li class="nav-item">
                <a class="nav-link mayuscula font-small d-flex align-items-center {{$class_no_active_text}}" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <div style="width: 30px;">
                        <i class="fas fa-sign-out-alt font-large margin-right-10"></i>
                    </div>
                    Salir
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
    @endif
</nav>
