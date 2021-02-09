<?php
if (!isset($rol)) $rol = new \Archinet\Models\Rol();
?>
<div class="row">
    <div class="col-12">
        <div class="md-form">
            {!! Form::label('nombre','Nombre',['class'=>'control-label active']) !!}
            {!! Form::text('nombre',$rol->nombre,['id'=>'nombre','class'=>'form-control alphabetical_space valid-restrict-field no-paste','placeholder'=>'Nombre del rol','maxlength'=>46]) !!}
            @if(!$rol->exists)
                <p class="count-length">45</p>
            @else
                <p class="count-length">{{45-strlen($rol->nombre)}}</p>
            @endif
            {!! Form::hidden('rol',$rol->id,['id'=>'rol']) !!}
        </div>
    </div>

    @php
        $rol_funcionario = \Archinet\Models\Rol::funcionario();
        $disabled = '';
        $checked = '';
        if($rol_funcionario){
                $disabled = 'disabled="disabled"';
                if($rol->exists && ($rol->id == $rol_funcionario->id)){
                    $checked = 'checked="checked"';
                    $disabled = '';
                }
        }
    @endphp

    @if(config('params.habilitar_roles_funcionarios'))
        <div class="col-12">
            <label>
                <input type="checkbox" name="funcionario" id="check_funcionario" value="si" {{$disabled}} {{$checked}}>Selecione
                si es funcionario
                SENA
            </label>
        </div>
    @endif
    <div class="col-12">
        <p class="titulo-per padding-top-10">Seleccione los permisos que tendrá este rol</p>
        <table class="table tabla-permisos">
            <div class="row permisos">
                <div class="modulo col-md-6"><h3>Módulos del sistema</h3></div>
                <div class="tar text-center tipografia col-md-6"><h3>Permisos</h3></div>
            </div>
            <thead class="opcion">
            <th class="funciones"></th>
            @foreach(\Archinet\Models\Funcion::get() as $f)
                <th class="text-center" width="80">{{$f->nombre}}</th>
            @endforeach
            </thead>
            <tbody>
            <?php
            $modulos = \Archinet\Models\Modulo::permitidos()->orderBy('nombre')->get();
            $funciones = \Archinet\Models\Funcion::get();
            ?>
            @foreach($modulos as $m)
                @if($m->funciones()->count() && $m->estado == 'Activo')
                    <tr>
                        <td class="etiqueta-tabla ">{{$m->etiqueta}}</td>
                        @foreach($funciones as $f)
                            <th class="text-center">
                                @if($m->tieneFuncion($f->id) && $m->usuarioTieneFuncion($f->identificador))
                                    <input type="checkbox" name="privilegios[]"
                                           value="{{$m->identificador.','.$f->identificador}}"
                                           @if($rol->exists && $rol->tieneFuncion($m->identificador,$f->identificador)) checked="checked" @endif>
                                @endif
                            </th>
                        @endforeach

                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>
