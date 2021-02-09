@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/rol/index.css') }}">
@endpush

@section('content')
        <div class="container-fluid white padding-50">
            <div class="row">
                <p class="titulo_principal margin-bottom-20">Roles</p>
                <div class="contenedor-opciones-vista-fixed">
                </div>
                <div class="col-12 no-padding text-right">
                    @if(Auth::user()->tieneFuncion($identificador_modulo, 'crear', $privilegio_superadministrador))
                        <a id="btn_modal_nuevo_rol" href="#!" class=" btnCrear  btn btn-primary right" title="Nuevo Rol"
                           style="">Crear rol</a>
                    @endif
                </div>
                <div class="col-sm-12 no-padding" style="min-height: 100px;" id="contenedor-roles">
                </div>

                <div class=" modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="mdlDetalles modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle" 
                            style="color:#000000;">Detalles</h5>
                            {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                            {{--<span aria-hidden="true">&times;</span>--}}
                            {{--</button>--}}
                        </div>
                        <div class="modal-body">

                            <div style="min-height: 100px;" id="contenedor-privilegios">
                                @include('rol.lista_privilegios')
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btnAceptar btn-success btn" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    @include('rol.modales')
@endsection

@push('js')
    <script src="{{asset('DataTables-1.10.15/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/rol/roles.js')}}"></script>
@endpush


