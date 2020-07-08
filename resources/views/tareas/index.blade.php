@extends('layouts.app')

@section('table')

<!-- Tabla -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><h4 class="m-0 font-weight-bold text-primary">Requerimientos</h4></span>
            <div class="group">
                @can('tareas.create')
                    <a href=" {{ route('tareas.create') }} " class="btn btn-sm btn-success">
                        <i class="fas fa-fw fa-plus"></i>
                        Nuevo Requerimiento
                    </a>
                @endcan
                @can('tareas.show')
                    <a href=" {{ route('tareas.reportes') }} " class="btn btn-sm btn-info" target="_blank">
                        <i class="fas fa-fw fa-file-alt"></i>
                        Reporte
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tareas-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Solicitud</th>
                            <th>Fecha de Inicio</th>
                            <th>Estado</th>
                            <th width="255">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

<!-- Modal Crear-->
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
                                <div class="row">
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo</label>
                                        <div class="col-md-2">
                                            <input id="codigo1" onkeyup="mayus(this);" type="text" pattern="[a-zA-Z]{3}" class="form-control" name="codigo1" required autocomplete="Codigo" autofocus>
                                        </div>
                                        <label for="codigo" class="col-form-label">-</label>
                                        <div class="col-md-2">
                                            <input id="codigo2" onkeyup="mayus(this);" type="text" pattern="[0-9]{4}" class="form-control" name="codigo2" required autocomplete="Codigo" autofocus>
                                        </div>
                                        <label for="codigo" class="col-form-label">-</label>
                                        <div class="col-md-2">
                                            <input id="codigo3" onkeyup="mayus(this);" type="text" pattern="[a-zA-Z0-9]{1}" class="form-control" name="codigo3" required autocomplete="Codigo" autofocus>
                                        </div>
                                    </div>
                                </div>

                            {{-- Fecha Inicio --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Inicio</label>
                                    <div class="col-md-6">
                                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                    </div>
                                </div>

                            {{-- Fecha Fin --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Fin</label>
                                    <div class="col-md-6">
                                        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required autocomplete="Fecha fin" autofocus>
                                    </div>
                                </div>

                            {{-- Direccion --}}
                                <div class="form-group row">
                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Direccion</label>
                                    <div class="col-md-6">
                                        <textarea id="direc" type="text" class="form-control" name="direc" required autocomplete="direccion" autofocus></textarea>
                                    </div>
                                </div>

                            {{-- Detalle --}}
                                <div class="form-group row">
                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Detalle</label>
                                    <div class="col-md-6">
                                        <textarea id="detalle" type="text" class="form-control" name="detalle" required autocomplete="detalle" autofocus></textarea>
                                    </div>
                                </div>

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

<!-- Revisar Tarea Modal -->
    <div class="modal fade" id="RevisaTareaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header bg-warning text-light">
                        <h5>Revision de estado del requerimiento</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">
                            <button type="button" class="btn btn-success" id="SubmitProcesoTareaForm">
                                <i class="fas fa-fw fa-spinner"></i>
                                En Proceso
                            </button>
                            <button type="button" class="btn btn-warning" id="SubmitAbandonarTareaForm">
                                <i class="fas fa-fw fa-times-circle"></i>
                                Abandonado
                            </button>
                            <button type="button" class="btn btn-danger" id="SubmitFinalizarTareaForm">
                                <i class="fas fa-fw fa-flag"></i>
                                Finalizada
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
                            Este requerimiento ya ha finalizado por lo que no es posible editar su informacion.
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

<!-- Delete Product Modal -->
    <div class="modal fade" id="DeleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5><b>Eliminar Tarea</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">¿Esta seguro de que desea eliminar esta tarea?.</h6>
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
                var table = $("#tareas-table").DataTable({
                    serverSide: true,
                    pageLength: 10,
                    ajax: '{!! route('datatables.tareas') !!}',
                    columns: [
                        { data: 'fake_id', name: 'tareas.fake_id' },
                        { data: 'codigo_solicitud', name: 'solicituds.codigo_solicitud' },
                        { data: 'fecha_inicio', name: 'tareas.fecha_inicio' },
                        { data: 'estado', name: 'tareas.estado'  },
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
                $("#btnCrearTarea").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaTareaModal").modal("show");
                });
            
            //Enviar detalle y observacion de obra al modal de revision
                $('#RevisaTareaModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var detalle = button.data('detalle') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #detalle').val(detalle)
                    
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var observacion = button.data('observacion') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #observacion').val(observacion)
                })

            //Enviar detalle y observacion de obra al modal de NoOption
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

            // Abandonar Tarea.
                var abandonarID;
                    $('body').on('click', '#getActualizaId', function(){
                        abandonarID = $(this).data('id');
                    })
                    $('#SubmitAbandonarTareaForm').click(function(e) {
                        e.preventDefault();
                        $("#alertModal").addClass("display-none").removeClass("alert-danger")
                        $("#inputId").val(null)
                        var id = abandonarID;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "tareas/abandonar/"+id,
                            method: 'PUT',
                            success: function(result) {
                                setImmediate(function(){
                                    $('#tareas-table').DataTable().ajax.reload();
                                    $('#RevisaTareaModal').modal('hide');
                                });
                            }
                        });
                    });

            // En Proceso Tarea.
                var procesoID;
                    $('body').on('click', '#getActualizaId', function(){
                        procesoID = $(this).data('id');
                    })
                    $('#SubmitProcesoTareaForm').click(function(e) {
                        e.preventDefault();
                        $("#alertModal").addClass("display-none").removeClass("alert-danger")
                        $("#inputId").val(null)
                        var id = procesoID;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "tareas/proceso/"+id,
                            method: 'PUT',
                            success: function(result) {
                                setImmediate(function(){
                                    $('#tareas-table').DataTable().ajax.reload();
                                    $('#RevisaTareaModal').modal('hide');
                                });
                            }
                        });
                    });

            // Finalizar Tarea.
                var finalizarID;
                    $('body').on('click', '#getActualizaId', function(){
                        finalizarID = $(this).data('id');
                    })
                    $('#SubmitFinalizarTareaForm').click(function(e) {
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
                            url: "tareas/finalizar/"+id,
                            method: 'PUT',
                            success: function(result) {
                                setImmediate(function(){
                                    $('#tareas-table').DataTable().ajax.reload();
                                    $('#RevisaTareaModal').modal('hide');
                                });
                            }
                        });
                    });

            // Resetear modal crear una vez que se cierra
                $('#creaTareaModal').on('hidden.bs.modal', function() {
                        $('#formTarea')[0].reset();
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
                        url: "tareas/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#tareas-table').DataTable().ajax.reload();
                                $('#DeleteProductModal').modal('hide');
                            });
                        }
                    });
                });

        });

    });
</script>
@endpush
