@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{asset('css/usuarios/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/historial_eventos/index.css')}}">
@endpush
@section('content')
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal">Historial Eventos</p>

            <div class="col-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-usuario'])
            </div>

            <div class="col-12 no-padding">
                <div class="row">
                    <div class="col-12 col-md-3 padding-top-none">
                        <div class="md-form">
                        {!! Form::label('Modulos','') !!}
                        {!! Form::select(null,[''=>'Seleccione','Usuarios'=>'Usuarios','Expedientes'=>'Expediente','Roles'=>'Roles'],null,['id'=>'modulo','class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-3 padding-top-none">
                        <div class="md-form">
                        {!! Form::label('Eventos','') !!}
                        {{--'Inicio sesión','Cierre sesión','Crear','Editar','Eliminar','Crear tipo documental','Editar tipo documental','Validar tipo documental'--}}
                        {!! Form::select(null,[''=>'Seleccione','Crear'=>'Crear','Editar'=>'Editar','Eliminar'=>'Eliminar','Inicio sesión'=>'Inicio sesión','Cierre sesión'=>'Cierre sesión','Crear tipo documental'=>'Crear tipo documental','Editar tipo documental'=>'Editar tipo documental','Validar tipo documental'=>'Validar tipo documental'],null,['id'=>'actividad','class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 padding-top-20">
                        <button class="btn btn-default right" onclick="exportarLog()">
                            Generar excel
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-12 padding-left-none padding-right-none">
                <table id="tabla-eventos" class="table table-striped table-bordered table-responsive-md">
                    <thead>

                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Fecha/hora</th>
                    <th>Evento</th>
                    <th>Modulo</th>
                    <th>Detalle</th>

                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content detalles">
                <div class="modal-detalles modal-header">
                    <h5 class="modal-detalles" id="exampleModalLabel" style="color: #000" ,>Detalles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div row>
                    <div class="modulo">
                        <p id="titulo_modulo">Historia Laboral</p>
                        <p id="titulo_evento"></p>
                    </div>
                    <div class=" modal-body">

                        
                        <p id="datos"></p>
                        <table class="table ">
                            <thead class="headTable">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Campos</th>
                                <th scope="col">Datos Anterior</th>
                                <th scope="col">Datos Nuevos</th>
                            </tr>
                            </thead>
                            <tbody id="informacion_evento">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btnAceptar btn-success btn" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('DataTables-1.10.15/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/historial_eventos/index.js')}}"></script>
    <script>
        var tiene_opciones = false;


        if (tiene_opciones) {
            var cols = [
                {data: 'nombreUsuario', name: 'nombreUsuario'},
                //{data: 'identificacion', name: 'identificacion'},
                {data: 'nombre', name: 'nombre'},
                {data: 'created_at', name: 'created_at'},
                {data: 'tipo', name: 'tipo'},
                {data: 'modulo', name: 'modulo'},

                {
                    data: 'opciones',
                    name: 'opciones',
                    orderable: false,
                    searchable: false,
                    "className": "text-center",
                    type: 'html'
                }
            ];
        } else {
            var cols = [
                {data: 'nombreUsuario', name: 'nombreUsuario'},
                //{data: 'identificacion', name: 'identificacion'},
                {data: 'nombre', name: 'nombre'},
                {data: 'created_at', name: 'created_at'},
                {data: 'tipo', name: 'tipo'},
                {data: 'modulo', name: 'modulo'},
                {

                    data: 'opciones',
                    name: 'opciones',
                    orderable: false,
                    searchable: false,
                    "className": "text-center",
                    "render": function (data, type, row, meta) {


                        if ((row.tipo.toLowerCase() == "crear") || (row.tipo.toLowerCase() == "inicio sesión") || (row.tipo.toLowerCase() == "cierre sesión")) {

                            return "";
                        } else {
                            return '<a data-new="' + data + '" data-modulo="' + row.modulo + '" data-evento="' + row.tipo + '"  onclick="abrirModal(this)" class="btn-xs margin-2" data-toggle="tooltip" data-placement="bottom" title="Detalles"><i class="green-text fa fa-angle-right font-x-large "></i></a>';
                            console.log(data);
                        }

                    }
                }
            ]
        }
        setCols(cols);
        cargarTablaEventos();

    </script>
@endpush
