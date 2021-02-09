<?php
    $privilegios = collect(session('rol')->dataPrivilegios())->where('estado','Activo')->sortBy('orden_menu')->groupBy('agrupacion');

    $privilegios->each(function ($item, $key) use ($privilegios, $class_active_bg, $class_active_text, $class_no_active_text){

    $dropdowns = [];
?>
        <?php foreach($item as $i){ ?>
            <?php if(Auth::user()->tieneFuncion($i['identificador'], 'ver', false)): ?>
                <?php if($key != ''): ?>
                    <?php if(!array_key_exists($key,$dropdowns)): ?>
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
                                <?php echo e(( Request::is(trim($elemento['url'],'/').'/*') ||  Request::is(trim($elemento['url'],'/')) )?$class_active_text:$class_no_active_text); ?>

                                " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo e($key); ?> <span class="caret"></span></a>
                            <div class="dropdown-menu">
                                <?php foreach ($privilegios[$key] as $elemento) { ?>
                                    <a class="dropdown-item <?php echo e(Request::is(trim($elemento['url'],'/').'/*') ||  Request::is(trim($elemento['url'],'/'))? $class_active_bg.' '.$class_active_text:$class_no_active_text); ?>" href="<?php echo e(url($elemento['url'])); ?>"><?php echo e($elemento['etiqueta']); ?></a>
                                <?php } ?>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item mayuscula font-small d-flex align-items-center <?php echo e(Request::is(trim($i['url'],'/').'/*') ||  Request::is(trim($i['url'],'/'))? $class_active_bg:''); ?>">
                        <a class="nav-link
                            <?php echo e(Request::is(trim($i['url'],'/').'/*') ||  Request::is(trim($i['url'],'/'))? $class_active_text:$class_no_active_text); ?>

                            " href="<?php echo e(url($i['url'])); ?>"><?php echo e($i['etiqueta']); ?></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php } ?>
<?php
    });

?>