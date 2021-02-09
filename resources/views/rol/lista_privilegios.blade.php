<div class="">
    <!-- Default panel contents -->

    <div class="row">
    
    <div class="rol"> El rol: {{isset($rol) ? ' '.$rol->nombre:''}}</div>

    </div>
    
    <!-- List group -->
   
    <div class="list-group lista">
        <p class="permiso rol">Tiene asignado los siguientes permisos</p>
        <div class="row texto1">
            <div class="col-md-6 texto">Modulos</div>
                    <div class="col-md-6 texto">Permisos</div>
                    </div>
        @if(isset($rol))
            @if($rol->privilegios)

                @foreach($rol->dataPrivilegios() as $pr)
                    <?php
                        $funciones = '';
                        for($i = 0; $i < count($pr['funciones']);$i++){
                            $funciones .= $pr['funciones'][$i].', ';
                        }
                        $funciones = trim($funciones);
                        $funciones = trim($funciones,',');
                    ?>            
                    <div class="row mod-funciones">
                    <div class="fun col-md-6">{{$pr['nombre']}}</div>
                    <div class="fun col-md-6">{{'('.$funciones.')'}}</div>
                    </div>
                @endforeach
            @else
                <li class="list-group-item">Rol sin privilegios asociados</li>
            @endif
        @else
            <li class="list-group-item">Lista de privilegios asociados a un rol</li>
        @endif
    </div>
</div>
