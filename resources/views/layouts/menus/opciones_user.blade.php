<?php
    $privilegios = collect(session('rol')->dataPrivilegios())->where('estado','Activo')->sortBy('orden_menu')->groupBy('agrupacion');

    $privilegios->each(function ($item, $key) use ($privilegios, $class_active_bg, $class_active_text, $class_no_active_text){

    $dropdowns = [];
?>
        <?php foreach($item as $i){ ?>
            @if (Auth::user()->tieneFuncion($i['identificador'], 'ver', false))
                @if($key != '')
                    @if(!array_key_exists($key,$dropdowns))
                        <?php $dropdowns[$key] = true; ?>
                        <li class="nav-item mayuscula font-small d-flex align-items-center dropdown

                            <?php
                                foreach ($privilegios[$key] as $elemento){
                                    if(Request::is(trim($elemento['url'],'/').'/*') ||  Request::is(trim($elemento['url'],'/'))){
                                        echo ' '.$class_active_bg;
                                        break;
                                    }
                                }
                            ?>
                                ">
                            <a href="#!" class="nav-link dropdown-toggle
                                {{( Request::is(trim($elemento['url'],'/').'/*') ||  Request::is(trim($elemento['url'],'/')) )?$class_active_text:$class_no_active_text}}
                                " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$key}} <span class="caret"></span></a>
                            <div class="dropdown-menu">
                                <?php foreach ($privilegios[$key] as $elemento) { ?>
                                    <a class="dropdown-item {{Request::is(trim($elemento['url'],'/').'/*') ||  Request::is(trim($elemento['url'],'/'))? $class_active_bg.' '.$class_active_text:$class_no_active_text}}" href="{{url($elemento['url'])}}">{{$elemento['etiqueta']}}</a>
                                <?php } ?>
                            </div>
                        </li>
                    @endif
                @else
                    <li class="nav-item mayuscula font-small d-flex align-items-center {{Request::is(trim($i['url'],'/').'/*') ||  Request::is(trim($i['url'],'/'))? $class_active_bg:''}}">
                        <a class="nav-link
                            {{Request::is(trim($i['url'],'/').'/*') ||  Request::is(trim($i['url'],'/'))? $class_active_text:$class_no_active_text}}
                            " href="{{url($i['url'])}}">{{$i['etiqueta']}}</a>
                    </li>
                @endif
            @endif
        <?php } ?>
<?php
    });

?>