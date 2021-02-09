@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{asset('css/usuarios/index.css')}}">
@endpush
@section('content')
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal margin-bottom-20">Historia Laboral</p>
            @if(session('msg'))
                <div class="md_import alert alert-warning alert-dismissible fade show" style="width: 100%" role="alert">
                    <h3 class="alert-heading">Información</h3>
                    <hr>
                    <p class="informacion" >{!! session('msg') !!}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
           <div class="botones_derecha ">
               <form action="{{url('/expediente/import')}}" method="POST" style="display: inline-block" id="frmImportar" enctype="multipart/form-data">
                   {{ csrf_field() }}
                   <input type="file" name="excel" style="display: none;" id="inputFile" accept=".xls, .xlsx, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                   <button class="btn-exportar btn btn-default btn-submit" id="importar_funcionarios" data-toggle="tooltip" data-placement="bottom" title="Sólo se permiten archivos de tipo excel">Importar Funcionarios</button>
               </form>

                @if(Auth::user()->tieneFuncion($identificador_modulo, 'crear', $privilegio_superadministrador))
                    <a href="{{url('/expediente/crear')}}" class="btnExpediente btnCustom btn-primary " data-placement="right"
                       title="Nuevo expediente">CREAR EXPEDIENTE</a>
                @endif
           </div>
            <div class="col-12">
                @include('layouts.alertas',['id_contenedor'=>'alertas-usuario'])
            </div>

            <div class="col-12 no-padding">

                <table id="tabla-expediente" class="table table-striped table-bordered table-responsive-md">
                    <thead>

                    <th>Apellidos y nombres</th>
                    <th>Identificación</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Estado</th>


                    @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones($identificador_modulo,['editar'],false,$privilegio_superadministrador))
                        <th class="text-center">Opciones</th>
                    @endif
                  </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('DataTables-1.10.15/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/expediente/index.js')}}"></script>
    <script>
        var tiene_opciones = false;

        @if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones($identificador_modulo,['editar'],false,$privilegio_superadministrador))
            tiene_opciones = true;
        @endif

        $(function () {


            if (tiene_opciones) {
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'identificacion', name: 'identificacion'},
                    {data: 'email', name: 'email'},
                    {data: 'direccion', name: 'direccion'},
                    {data: 'estado', name: 'estado'},

                    {
                        data: 'opciones',
                        name: 'opciones',
                        orderable: false,
                        searchable: false,
                        "className": "text-center"
                    }
                ];
            } else {
                var cols = [
                    {data: 'nombre', name: 'nombre'},
                    {data: 'identificacion', name: 'identificacion'},
                    {data: 'email', name: 'email'},
                    {data: 'direccion', name: 'direccion'},
                    {data: 'estado', name: 'estado'},

                    {data: 'rol', name: 'rol'},
                    {
                        data: 'opciones',
                        name: 'opciones',
                        orderable: false,
                        searchable: false,
                        "className": "text-center"
                    }
                ]
            }
            setCols(cols);
            cargarTablaFuncionarios();
        })
    </script>
@endpush
