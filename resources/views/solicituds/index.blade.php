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
                    <!--
                    <button type="button" id="btnCrearSolicitud" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i>
                        Nueva Solicitud
                    </button>-->
                @endcan
                @can('solicitudes.show')
                    <a href="{{ route('solicituds.reportes') }}" class="btn btn-sm btn-info">
                        <i class="fas fa-fw fa-file-alt"></i>
                        Reporte
                    </a>
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


<!-- Modal Crear-->
    <div class="modal fade" id="creaSolicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Solicitud</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formSolicitud" method="POST" action="{{ route('solicituds.store') }}">
                            @csrf
                            {{-- Codigo --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-3 col-form-label">Codigo</label>
                                    <div class="col-md-9">
                                        <input id="codigo" type="text" pattern="{9}" class="form-control" name="codigo" required autocomplete="Codigo" autofocus>
                                    </div>
                                </div>

                            {{-- Cedula Solicitante --}}
                                <div class="form-group row">
                                    <label for="user_id" class="col-md-3 col-form-label">Cedula del Solicitante</label>
                                    <div class="col-md-9">
                                        <input id="cliente_id" type="text" pattern="[0-9]{10}" class="form-control" name="cliente_id" required autocomplete="Cedula Solicitante" autofocus>
                                    </div>
                                </div>

                            {{-- Detalle --}}
                                <div class="form-group row">
                                    <label for="detalle" class="col-md-3 col-form-label">Detalle</label>
                                    <div class="col-md-9">
                                        <textarea id="detalle" type="text" class="form-control" name="detalle" required autocomplete="detalle" autofocus></textarea>
                                    </div>
                                </div>

                            {{-- ID del usuario --}}
                                <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formSolicitud" id="submitBtn" class="btn btn-primary">Agregar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- Modal CrearTarea-->
    <div class="modal fade" id="creaTareaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Tarea</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formTarea" method="POST" action="{{ route('tareas.store') }}">
                            @csrf
                            {{-- Codigo --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-3 col-form-label">Codigo</label>
                                    <div class="col-md-9">
                                        <input id="codigo" type="text" pattern="{9}" class="form-control" value="" name="codigo" required autocomplete="Codigo" autofocus>
                                    </div>
                                </div>

                            {{-- Cedula Solicitante --}}
                                <div class="form-group row">
                                    <label for="user_id" class="col-md-3 col-form-label">Cedula del Solicitante</label>
                                    <div class="col-md-9">
                                        <input id="cliente_id" type="text" pattern="[0-9]{10}" class="form-control" name="cliente_id" required autocomplete="Cedula Solicitante" autofocus>
                                    </div>
                                </div>

                            {{-- Detalle --}}
                                <div class="form-group row">
                                    <label for="detalle" class="col-md-3 col-form-label">Detalle</label>
                                    <div class="col-md-9">
                                        <textarea id="detalle" type="text" class="form-control" name="detalle" required autocomplete="detalle" autofocus></textarea>
                                    </div>
                                </div>

                            {{-- ID del usuario --}}
                                <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formTarea" id="submitBtn" class="btn btn-primary">Agregar</button>
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

            // modal crear
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
