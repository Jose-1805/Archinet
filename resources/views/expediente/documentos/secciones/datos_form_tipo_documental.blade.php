<div class="row">
    <h5 class="col-12 mayuscula" id="titulo_tipo_documental">{{$tipo_documental->nombre}}</h5>
    <div class="col-12">
        <div class="col-12 border">
            <div class="row">
                @include('expediente.documentos.secciones.datos_basicos_tipo_documental')
                @php($view = 'expediente.documentos.secciones.'.$tipo_documental->seccion->nombre_carpeta.'.'.$tipo_documental->carpeta.'.datos_form')

                @if(\Illuminate\Support\Facades\View::exists($view))
                    @include($view)
                @endif

                <div class="col-12 grey lighten-4 padding-top-20 margin-top-20 padding-bottom-20">
                    @if(Auth::user()->tieneFuncion($identificador_modulo, 'validar_documentos', $privilegio_superadministrador))
                        @php($checked = '')
                        @if(isset($documento) && $documento->validado == 'si')
                            @php($checked = 'checked')
                        @endif
                        <label>
                            <input type="checkbox" name="validar" value="si" {{$checked}}> Seleccione si el documento está validado
                        </label>
                    @endif
                    <div class="md-form margin-top-30" id="contenedor-upload">
                        {!! Form::label('archivo','Archivo', ['class'=>'active padding-bottom-10']) !!}
                        {!! Form::file('archivo',['id'=>'archivo','class'=>'form-control', 'accept'=>'application/pdf']) !!}
                    </div>
                </div>
                {!! Form::hidden('tipo_documental',$tipo_documental->id) !!}
            </div>
        </div>
    </div>
</div>