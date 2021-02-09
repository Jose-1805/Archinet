@extends('layouts.app')

@section('content')
   @php(
    $vistaCarpetas = isset($_GET['type'])
    )
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal">Expediente <strong class="teal-text">{{$user->fullName()}}</strong></p>

            <div class="col-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-usuario'])
            </div>

            <div class="col-12 padding-top-none">
                <div class="row">
                    <div class="col-md-6 visualizar padding-top-none" style="margin-top: -10px;">
                        @if(session('rol')->superadministrador == "si")
                            {!! Form::label('vista','VER EXPEDIENTE POR:') !!}
                        @elseif(session('rol')->funcionario == "si")
                            {!! Form::label('vista','VER MI EXPEDIENTE POR:') !!}
                        @endif
                        {!! Form::select('vista',['2'=>'cronológico','1'=>'secciones'],null,['id'=>'vista','class'=>'form-control']) !!}
                    </div>

                    @if(Auth::user()->tieneFuncion($identificador_modulo, 'crear', $privilegio_superadministrador))
                        <div class="col-md-6 no-padding">
                            <a class="btn btn-primary right" data-toggle="modal" data-target="#modal-seleccion-tipo-documental">Registrar tipo documental</a>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row" style="display: none;" id="contenedor-vista-historial-laboral">
                            @include('expediente.documentos.vista_secciones')
                        </div>

                        <div class="row" style="display: none;"  id="contenedor-vista-historial-laboral-cronologico">
                           
                            <table  id="tabla-tipos-documentales" class="table table-striped table-bordered table-responsive-md">      
                                <thead>
                                    <tr>
                                        <th colspan="3">
                                            <h5>Funcionario:</h5>
                                            <strong >{{$user->fullName()}}</strong>
                                        </th>
                                        <th colspan="2">
                                            <h5>Identificación:</h5>
                                            <strong >{{$user->identificacion}}</strong>
                                        </th>
                                    </tr>
                                    <tr>    
                                        <th>Fecha Ingreso del documento</th>
                                        <th >Tipo Documental</th>
                                        <th>Nª Folio</th>
                                        <th >Observaciones</th>
                                        @if(session('rol')->funcionario != "si")
                                            <th >Editar</th>
                                        @endif
                                    </tr>
                                </thead>
                            </table>

                            <div class="botones">
                                <a href="{{url('/expediente/')}}" class="btn-guardar btn btn-default btn-submit"
                                   id="">REGRESAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->tieneFuncion($identificador_modulo, 'crear', $privilegio_superadministrador))
        <div class="modal fade" id="modal-seleccion-tipo-documental" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Seleccione el tipo documental que desea registrar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id'=>'form-seleccion-tipo-documental']) !!}
                        <div class="md-form">
                            @php(
                                $tipos_documentales = [''=>'Seleccione']+$tiposDocumentales->pluck('nombre','id')->toArray()
                            )
                            {!! Form::select
                           ('seleccion_tipo_documental',$tipos_documentales,null,
                            ['id'=>'seleccion_tipo_documental','class'=>'md-form form-control']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn-seleccion-tipo-documental">Registrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-registrar-tipo-documental" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mayuscula" id="exampleModalLabel">Ingrese los datos de este tipo documental</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id'=>'form-registrar-tipo-documental']) !!}
                        {!! Form::hidden('usuario',$user->id) !!}
                        <div class="" id="contenedor-datos-tipo-documental">

                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Regresar</button>
                        <button type="button" class="btn btn-primary" id="btn-guardar-tipo-documental">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Auth::user()->tieneFuncion($identificador_modulo, 'editar', $privilegio_superadministrador))
        <div class="modal fade" id="modal-editar-documento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mayuscula" id="exampleModalLabel">Actualizar los datos de este tipo documental</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Regresar</button>
                        <button type="button" class="btn btn-primary" id="btn-validar-editar-documento">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-validar-editar-documento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mayuscula" id="exampleModalLabel">Confirmar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro de actualizar este documento?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="btn-no-editar-documento">NO</button>
                        <button type="button" class="btn btn-primary" id="btn-editar-documento">SI</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

   <div class="modal fade" id="modal-ver-documento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Información de documento</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
               </div>
           </div>
       </div>
   </div>

   <div class="modal fade" id="modal-seleccionar-institucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
       <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Instituciones</h5>
                   <button type="button" class="close" id="cerrar_seleccionar_instituciones">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>

               <div class="modal-body">
                   @include('layouts.seleccion_instituciones')
               </div>
           </div>
       </div>
   </div>
@endsection

@push('js')
    <script src="{{asset('DataTables-1.10.15/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('/js/expediente/funcionario.js')}}"></script>
    <script>
        var userId = {{ $user->id }};
        var seccionId = null;
        var tiene_opciones = true;

        //cargarTablaTiposDocumentales();

        @if($vistaCarpetas)
            $('#vista option[value="1"]').attr("selected", true);
            $('#contenedor-vista-historial-laboral').show();
        @else
            $('#contenedor-vista-historial-laboral-cronologico').show();
        @endif

        @if(session('rol')->funcionario == "si")
            tiene_opciones = false;
        @endif

        $(function () {

            if (tiene_opciones) {
                var cols = [
                    {data: 'fecha_documento', name: 'fecha_documento'},
                    {data: 'tipo_documental', name: 'tipo_documental'},
                    {data: 'numero_folio', name: 'numero_folio', className: 'text-center'},
                    {data: 'observaciones', name: 'observaciones'},
                    {render:
                        function (data, type, JsonResultRow, meta) {
                            return '<a class="btn-editar-documento btn btn-xs btn-primary" data-documento="'+JsonResultRow.id+'" href="#!"><i class="fas fa-edit"></i></a>';
                        }
                        ,className:'text-center'
                    }

                ];
            } else {
                var cols = [
                    {data: 'fecha_documento', name: 'fecha_documento'},
                    {data: 'tipo_documental', name: 'tipo_documental'},
                    {data: 'numero_folio', name: 'numero_folio', className: 'text-center'},
                    {data: 'observaciones', name: 'observaciones'},

                ]
            }
            setCols(cols);
            cargarTablaTiposDocumentales();
        })
    </script>
    <script src="{{asset('js/seleccion_instituciones.js')}}"></script>
@endpush