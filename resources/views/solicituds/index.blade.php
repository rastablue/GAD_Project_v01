@extends('layouts.app')

@section('table')
<!-- Tabla -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><h4 class="m-0 font-weight-bold text-primary">Solicitudes</h4></span>
            <div class="group">
                @can('solicitudes.create')
                    <a href="{{ route('solicituds.create') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i>
                        Nueva Solicitud
                    </a>
                @endcan
                @can('solicitudes.show')
                    <button type="button" id="btnCrearSolicitud" class="btn btn-info btn-sm">
                        <i class="fas fa-fw fa-file-alt"></i>
                        Reporte
                    </button>
                    <!--<a href="{{ route('solicituds.reportes') }}" class="btn btn-sm btn-info" target="_blank">
                        <i class="fas fa-fw fa-file-alt"></i>
                        Reporte
                    </a>-->
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="solicitudes-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Fecha de Emision</th>
                            <th width="90px">Nombre Solicitante</th>
                            <th width="90px">Apellido Solicitante</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

<!-- Modal Reportes-->
    <div class="modal fade" id="creaSolicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Reporte de Solicitud</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body text-center">
                        <form id="formSolicitud" method="POST" action="{{ route('solicituds.store') }}">
                            @csrf
                            
                            <a href="{{ route('solicituds.reportesaprobado') }}" class="btn btn-success mt-3" target="_blank">
                                Solicitudes Aprobadas
                            </a>
                            <br>
                            <a href="{{ route('solicituds.reportespendientes') }}" class="btn btn-warning text-dark mt-3" target="_blank">
                                Solicitudes pendientes
                            </a>
                            <br>
                            <a href="{{ route('solicituds.reportesreprobado') }}" class="btn btn-danger mt-3" target="_blank">
                                Solicitudes Reprobadas
                            </a>
                            <br>
                            <a href="{{ route('solicituds.reporteselect') }}" class="btn btn-primary mt-3" target="_blank">
                                Desde - Hasta
                            </a>
                            <br>
                            <a href="{{ route('solicituds.reportes') }}" class="btn btn-primary mt-3" target="_blank">
                                Todos los Registros
                            </a>

                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- Revisar Solicitud Modal -->
    <div class="modal fade" id="RevisaSolicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header bg-warning text-light">
                        <h5>Revision de estado de solicitud</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">
                            <button type="button" class="btn btn-success" id="SubmitAprobarSolicitudForm">
                                <i class="fas fa-fw fa-check-circle"></i>
                                Aprobar
                            </button>
                            <button type="button" class="btn btn-danger" id="SubmitReprobarSolicitudForm">
                                <i class="fas fa-fw fa-times-circle"></i>
                                Reprobar
                            </button>
                            <div class="text-md-left mt-2">
                                <label for="Detalle">Detalle:</label>
                                <textarea name="" id="detalle" disabled class="form-control detalle"></textarea>
                            </div>
                            <div class="text-md-left mt-2">
                                <label for="Observacion">Observacion:</label>
                                <textarea name="" id="observacion" disabled class="form-control observacion"></textarea>
                            </div>
                    </div>
            </div>
        </div>
    </div>

<!-- NoOptionModal -->
    <div class="modal fade" id="NoOptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header bg-warning text-light">
                        <h5>Advertencia</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">
                            Esta solicitud a finalizado o fue reprobada por lo que no es posible editar su informacion.
                        </h6>
                        <div class="text-md-left mt-2">
                            <label for="Detalle">Detalle:</label>
                            <textarea name="" id="detalle" disabled class="form-control detalle"></textarea>
                        </div>
                        <div class="text-md-left mt-2">
                            <label for="Observacion">Observacion:</label>
                            <textarea name="" id="observacion" disabled class="form-control observacion"></textarea>
                        </div>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- FinalizadoModal -->
    <div class="modal fade" id="FinalizadoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header bg-warning text-light">
                        <h5>Solicitud Finalizada</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="alert alert-info" role="alert">
                            <label for="Detalle">Fecha de finalizacion:  </label>
                            <b><span id="finalizacion"></span></b>
                        </div>
                        <hr>
                        <div class="text-md-left mt-2">
                            <label for="Detalle">Detalle:</label>
                            <textarea name="" id="detalle" disabled class="form-control detalle"></textarea>
                        </div>
                        <div class="text-md-left mt-2">
                            <label for="Observacion">Observacion:</label>
                            <textarea name="" id="observacion" disabled class="form-control observacion"></textarea>
                        </div>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- Finaliza solicitud Modal -->
    <div class="modal fade" id="FinalizaSolicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header bg-warning text-light">
                        <h5><b>Finalizar Solicitud</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">Finalizar esta solicitud tambien finalizara todos los requerimientos vinculados
                                            que se encuentren en estado aprobado y los que estan en espera, pasaran a estado
                                            de abandono. <br><br> ¿Desea continuar?</h6>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="SubmitFinalizarSolicitudForm">Finalizar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- Delete Product Modal -->
    <div class="modal fade" id="DeleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5><b>Eliminar Solicitud</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">Eliminar esta solicitud tambien eliminara todas las tareas vinculadas. <br> ¿Desea continuar?</h6>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="SubmitDeleteProductForm">Eliminar</button>
                    </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
<!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JavaScript -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function() {
        $(document).ready(function(){

            // initializing Datatable
                var table = $("#solicitudes-table").DataTable({
                    serverSide: true,
                    pageLength: 10,
                    ajax: '{!! route('datatables.solicituds') !!}',
                    columns: [
                        { data: 'codigo_solicitud', name: 'solicituds.codigo_solicitud' },
                        { data: 'fecha_emision', name: 'solicituds.fecha_emision' },
                        { data: 'name', name: 'clientes.name' },
                        { data: 'apellido_pater', name: 'clientes.apellido_pater' },
                        { data: 'estado', name: 'solicituds.estado'  },
                        { data: 'btn', name: 'btn',orderable:false,serachable:false,sClass:'text-center' }
                    ],
                    "language":{
                        "info": "_TOTAL_ registros",
                        "search": "Buscar:",
                        "paginate": {
                            "next": ">>",
                            "previous": "<<"
                        },
                        "lengthMenu": 'Mostrar <select>'+
                                    '<option value="5">5</option>'+
                                    '<option value="10">10</option>'+
                                    '<option value="20">20</option>'+
                                    '<option value="40">40</option>'+
                                    '<option value="-1">Todos</option>'+
                                    '</select> registros',
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "emptyTable": "No hay datos",
                        "zeroRecords": "No hay coincidencias",
                        "infoEmpty": "",
                        "infoFiltered": ""
                    }
                });

            // modal reportes
                $("#btnCrearSolicitud").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaSolicitudModal").modal("show");
                });

            // Resetear modal crear una vez que se cierra
                $('#creaSolicitudModal').on('hidden.bs.modal', function() {
                        $('#formSolicitud')[0].reset();
                    });
                
            // Enviar detalle y observacion al modal de revision
                $('#RevisaSolicitudModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var detalle = button.data('detalle') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #detalle').val(detalle)
                    
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var observacion = button.data('observacion') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #observacion').val(observacion)
                })

            // Enviar detalle y observacion al modal de advertencia
                $('#NoOptionModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var detalle = button.data('detalle') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #detalle').val(detalle)
                    
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var observacion = button.data('observacion') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #observacion').val(observacion)
                })

            // Enviar detalle, observacion y fecha al modal de finalizado
                $('#FinalizadoModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var detalle = button.data('detalle') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #detalle').val(detalle)
                    
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var observacion = button.data('observacion') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #observacion').val(observacion)

                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var fecha = button.data('fecha') // Extract info from data-* attributes
                    var modal = $(this)
                    $('#finalizacion').html(fecha);
                })

            // Aprobar Solicitud.
                var aprobarID;
                var observacion;
                    $('body').on('click', '#getActualizaId', function(){
                        aprobarID = $(this).data('id');
                        observacion = $(this).data('observacion');
                    })
                    $('#SubmitAprobarSolicitudForm').click(function(e) {
                        e.preventDefault();
                        $("#alertModal").addClass("display-none").removeClass("alert-danger")
                        $("#inputId").val(null)
                        var id = aprobarID;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "solicituds/aprobar/"+id,
                            method: 'PUT',
                            success: function(result) {
                                setImmediate(function(){
                                    $('#solicitudes-table').DataTable().ajax.reload();
                                    $('#RevisaSolicitudModal').modal('hide');
                                });
                            }
                        });
                    });

            // Reprobar Solicitud.
                var repruebaID;
                    $('body').on('click', '#getActualizaId', function(){
                        repruebaID = $(this).data('id');
                    })
                    $('#SubmitReprobarSolicitudForm').click(function(e) {
                        e.preventDefault();
                        $("#alertModal").addClass("display-none").removeClass("alert-danger")
                        $("#inputId").val(null)
                        var id = repruebaID;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "solicituds/reprobar/"+id,
                            method: 'PUT',
                            success: function(result) {
                                setImmediate(function(){
                                    $('#solicitudes-table').DataTable().ajax.reload();
                                    $('#RevisaSolicitudModal').modal('hide');
                                });
                            }
                        });
                    });

            // Finalizar Tarea.
                var finalizarID;
                    $('body').on('click', '#getActualizaId', function(){
                        finalizarID = $(this).data('id');
                    })
                    $('#SubmitFinalizarSolicitudForm').click(function(e) {
                        e.preventDefault();
                        $("#alertModal").addClass("display-none").removeClass("alert-danger")
                        $("#inputId").val(null)
                        var id = finalizarID;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "solicituds/finalizar/"+id,
                            method: 'PUT',
                            success: function(result) {
                                setImmediate(function(){
                                    $('#solicitudes-table').DataTable().ajax.reload();
                                    $('#FinalizaSolicitudModal').modal('hide');
                                });
                            }
                        });
                    });

            // Eliminar Ajax request.
                var deleteID;
                $('body').on('click', '#getDeleteId', function(){
                    deleteID = $(this).data('id');
                })
                $('#SubmitDeleteProductForm').click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    var id = deleteID;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "solicituds/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#solicitudes-table').DataTable().ajax.reload();
                                $('#DeleteProductModal').modal('hide');
                            });
                        }
                    });
                });

        });

    });
</script>
@endpush
