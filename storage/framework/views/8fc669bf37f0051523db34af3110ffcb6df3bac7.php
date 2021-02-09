<?php (
    $documentos = \Archinet\Models\Documento::
    select('documentos.*','tipos_documentales.nombre as tipo_documental')
        ->join('tipos_documentales','documentos.tipo_documental_id','=','tipos_documentales.id')
        ->join('secciones','tipos_documentales.seccion_id','=','secciones.id')
        ->where('documentos.user_id',$user->id)
        ->where('secciones.id',$seccion->id)
        ->get()
); ?>

<?php (
$vistaCarpetas = isset($_GET['type'])
); ?>

<?php $__env->startSection('content'); ?>
    <script>
        var seccionId = "<?php echo e($seccion->id); ?>";
        var userId = "<?php echo e($user->id); ?>"
    </script>
    <div class="container-fluid white padding-50">
        <div class="row">
            <p class="titulo_principal">Expediente <strong class="teal-text"><?php echo e($user->fullName()); ?>

                    / <?php echo e($seccion->nombre); ?></strong></p>
            <div class="col-12">
                <?php echo $__env->make('layouts.alertas',['id_contenedor'=>'alertas-usuario'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <?php if(Auth::user()->tieneFuncion($identificador_modulo, 'crear', $privilegio_superadministrador)): ?>
                <div class="col-12 padding-top-none">
                    <a class="btn btn-primary right" data-toggle="modal" data-target="#modal-seleccion-tipo-documental">Registrar
                        tipo documental</a>
                </div>
            <?php endif; ?>
            <div class="col-12">
                <div class="list-group">
                    <table id="tabla-tipos-documentales" class="table table-striped table-bordered table-responsive-md">
                        <thead>
                        <tr>

                            <th colspan="3"><h5>Funcionario:</h5> <strong><?php echo e($user->fullName()); ?></strong></th>
                            <th colspan="2"><h5>Identificacion:</h5>
                                <strong><?php echo e($user->identificacion); ?></strong></th>

                        </tr>
                        <tr>
                            <th>Fecha Ingreso del documento</th>
                            <th >Tipo Documental</th>
                            <th>Nª Folio</th>
                            <th>Observaciones</th>
                            <?php if(session('rol')->funcionario != "si"): ?>
                                <th >Editar</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                    </table>
                    <div class="botones">
                        <a href="<?php echo e(url('/expediente/')); ?>/<?php echo e($user->id); ?>?type=2" class="btn-guardar btn btn-default btn-submit"
                           id="">REGRESAR</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php if(Auth::user()->tieneFuncion($identificador_modulo, 'crear', $privilegio_superadministrador)): ?>
        <div class="modal fade" id="modal-seleccion-tipo-documental" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Seleccione el tipo documental que desea
                            registrar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo Form::open(['id'=>'form-seleccion-tipo-documental']); ?>

                        <div class="md-form">
                            <?php (
                                $tipos_documentales = [''=>'Seleccione']+$seccion->tiposDocumentales()->orderBy('nombre')->pluck('nombre','id')->toArray()
                            ); ?>
                            <?php echo Form::select('seleccion_tipo_documental',$tipos_documentales,null,['id'=>'seleccion_tipo_documental','class'=>'md-form form-control']); ?>

                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn-seleccion-tipo-documental">Registrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-registrar-tipo-documental" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ingrese los datos de este tipo documental</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo Form::open(['id'=>'form-registrar-tipo-documental']); ?>

                        <?php echo Form::hidden('usuario',$user->id); ?>

                        <div class="" id="contenedor-datos-tipo-documental">

                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Regresar</button>
                        <button type="button" class="btn btn-primary" id="btn-guardar-tipo-documental">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(Auth::user()->tieneFuncion($identificador_modulo, 'editar', $privilegio_superadministrador)): ?>
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
    <?php endif; ?>

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
                </div>

                <div class="modal-body">
                    <?php echo $__env->make('layouts.seleccion_instituciones', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('/js/expediente/funcionario.js')); ?>"></script>
    <script src="<?php echo e(asset('DataTables-1.10.15/media/js/jquery.dataTables.js')); ?>"></script>
    <script>
        var tiene_opciones = false;
            <?php if($vistaCarpetas): ?>
                $('#vista option[value="1"]').attr("selected", true);
                $('#contenedor-vista-historial-laboral').show();
            <?php else: ?>
                $('#contenedor-vista-historial-laboral-cronologico').show();
            <?php endif; ?>
        <?php if(\Illuminate\Support\Facades\Auth::user()->tieneFunciones($identificador_modulo,['editar'],false,$privilegio_superadministrador) && session('rol')->funcionario != "si"): ?>
            tiene_opciones = true;
        <?php endif; ?>

        $(function () {

            if (tiene_opciones) {
                var cols = [
                    {data: 'fecha_documento',    name: 'fecha_documento'},
                    {data: 'tipo_documental',    name: 'tipo_documental'},
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
                    {
                        render:
                            function (data, type, JsonResultRow, meta) {
                                return '<a class="btn-ver-documento" data-documento="'+JsonResultRow.id+'" href="#!">' + JsonResultRow.tipo_documental + '</a>';
                            }
                    },
                    {data: 'numero_folio', name: 'numero_folio', className: 'text-center'},
                    {data: 'observaciones', name: 'observaciones'},

                ]
            }
            setCols(cols);
            cargarTablaTiposDocumentales();
        })
    </script>
    <script src="<?php echo e(asset('js/seleccion_instituciones.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>