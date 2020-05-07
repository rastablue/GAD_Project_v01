@extends('layouts.app')

@section('content')
<!-- Tabla -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4 class="m-0 font-weight-bold text-primary">Mantenimientos</h4></span>
                        <div class="group">
                            @can('mantenimientos.create')
                                <a href=" {{ route('mantenimientos.create') }} " class="btn btn-sm btn-success">
                                    <i class="fas fa-fw fa-plus"></i>
                                    Nuevo Mantenimiento
                                </a>
                            @endcan
                            @can('mantenimientos.show')
                                <button type="button" id="btnCrearSolicitud" class="btn btn-info btn-sm">
                                    <i class="fas fa-fw fa-file-alt"></i>
                                    Reporte
                                </button>
                                <!--<a href=" {{ route('mantenimientos.reportes') }} " class="btn btn-sm btn-info" target="_blank">
                                    <i class="fas fa-fw fa-file-alt"></i>
                                    Reporte
                                </a>-->
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="mantenimientos-table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nro. Ficha</th>
                                        <th>Placa</th>
                                        <th width="150px">Fecha de Ingreso</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Reportes-->
    <div class="modal fade" id="creaSolicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Reporte de Mantenimientos</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body text-center">
                            
                        <a href="{{ route('mantenimientos.reportesactivo') }}" class="btn btn-success mt-3" target="_blank">
                            Mantenimientos Activos
                        </a>
                        <br>
                        <a href="{{ route('mantenimientos.reportesespera') }}" class="btn btn-info mt-3" target="_blank">
                            Mantenimientos En espera
                        </a>
                        <br>
                        <a href="{{ route('mantenimientos.reportesinactivo') }}" class="btn btn-warning mt-3 text-dark" target="_blank">
                            Mantenimientos Inactivos
                        </a>
                        <br>
                        <a href="{{ route('mantenimientos.reportesfinalizado') }}" class="btn btn-danger mt-3" target="_blank">
                            Mantenimientos Finalizados
                        </a>
                        <br>
                        <a href="{{ route('mantenimientos.reporteselect') }}" class="btn btn-primary mt-3">
                            Desde - Hasta
                        </a>
                        <br>
                        <a href="{{ route('mantenimientos.reportes') }}" class="btn btn-primary mt-3" target="_blank">
                            Todos los Registros
                        </a>

                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                        <h5>Revision de estado del mantenimiento</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">
                            <button type="button" class="btn btn-success" id="SubmitActivoForm">
                                <i class="fas fa-fw fa-check-circle"></i>
                                Activo
                            </button>
                            <button type="button" class="btn btn-info" id="SubmitEsperaForm">
                                <i class="fas fa-fw fa-spinner"></i>
                                En espera
                            </button>
                            <button type="button" class="btn btn-warning" id="SubmitInactivoForm">
                                <i class="fas fa-fw fa-times-circle"></i>
                                Inactivo
                            </button>
                            <button type="button" class="btn btn-danger" id="SubmitFinalizarForm">
                                <i class="fas fa-fw fa-flag"></i>
                                Finalizar
                            </button>
                            <div class="text-md-left mt-2">
                                <label for="Diagnostico">Diagnostico:</label>
                                <textarea name="" id="diagnostico" disabled class="form-control diagnostico"></textarea>
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
                            Este mantenimiento ya ha finalizado por lo que no es posible editar su informacion.
                        </h6>
                        <div class="text-md-left mt-2">
                            <label for="Diagnostico">Diagnostico:</label>
                            <textarea name="" id="diagnostico" disabled class="form-control diagnostico"></textarea>
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
                        <h5><b>Eliminar Mantenimiento</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">Eliminar este mantenimiento tambien eliminara todos los trabajos vinculados. <br> ¿Desea continuar?</h6>
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
                var table = $("#mantenimientos-table").DataTable({
                    serverSide: true,
                    pageLength: 10,
                    ajax: '{!! route('datatables.mantenimientos') !!}',
                    columns: [
                        { data: 'codigo', name: 'mantenimientos.codigo' },
                        { data: 'placa', name: 'maquinarias.placa' },
                        { data: 'fecha_ingreso', name: 'mantenimientos.fecha_ingreso' },
                        { data: 'estado', name: 'mantenimientos.estado'  },
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

            // Enviar diagnostico y observacion al modal de revision
                $('#RevisaTareaModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var diagnostico = button.data('diagnostico') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #diagnostico').val(diagnostico)
                    
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var observacion = button.data('observacion') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #observacion').val(observacion)
                })

            // Enviar diagnostico y observacion al modal de NoOption
                $('#NoOptionModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var diagnostico = button.data('diagnostico') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #diagnostico').val(diagnostico)
                    
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var observacion = button.data('observacion') // Extract info from data-* attributes
                    var modal = $(this)
                    modal.find('.modal-body #observacion').val(observacion)
                })

            // Activar Mantenimiento.
                var activoID;
                    $('body').on('click', '#getActualizaId', function(){
                        activoID = $(this).data('id');
                    })
                    $('#SubmitActivoForm').click(function(e) {
                        e.preventDefault();
                        $("#alertModal").addClass("display-none").removeClass("alert-danger")
                        $("#inputId").val(null)
                        var id = activoID;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "mantenimientos/activo/"+id,
                            method: 'PUT',
                            success: function(result) {
                                setImmediate(function(){
                                    $('#mantenimientos-table').DataTable().ajax.reload();
                                    $('#RevisaTareaModal').modal('hide');
                                });
                            }
                        });
                    });

            // En Espera Mantenimiento.
                var esperaID;
                    $('body').on('click', '#getActualizaId', function(){
                        esperaID = $(this).data('id');
                    })
                    $('#SubmitEsperaForm').click(function(e) {
                        e.preventDefault();
                        $("#alertModal").addClass("display-none").removeClass("alert-danger")
                        $("#inputId").val(null)
                        var id = esperaID;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "mantenimientos/espera/"+id,
                            method: 'PUT',
                            success: function(result) {
                                setImmediate(function(){
                                    $('#mantenimientos-table').DataTable().ajax.reload();
                                    $('#RevisaTareaModal').modal('hide');
                                });
                            }
                        });
                    });

            // Inactivo Mantenimiento.
                var inactivoID;
                    $('body').on('click', '#getActualizaId', function(){
                        inactivoID = $(this).data('id');
                    })
                    $('#SubmitInactivoForm').click(function(e) {
                        e.preventDefault();
                        $("#alertModal").addClass("display-none").removeClass("alert-danger")
                        $("#inputId").val(null)
                        var id = inactivoID;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "mantenimientos/inactivo/"+id,
                            method: 'PUT',
                            success: function(result) {
                                setImmediate(function(){
                                    $('#mantenimientos-table').DataTable().ajax.reload();
                                    $('#RevisaTareaModal').modal('hide');
                                });
                            }
                        });
                    });

            // Finalizar Mantenimiento.
                var finalizarID;
                    $('body').on('click', '#getActualizaId', function(){
                        finalizarID = $(this).data('id');
                    })
                    $('#SubmitFinalizarForm').click(function(e) {
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
                            url: "mantenimientos/finalizar/"+id,
                            method: 'PUT',
                            success: function(result) {
                                setImmediate(function(){
                                    $('#mantenimientos-table').DataTable().ajax.reload();
                                    $('#RevisaTareaModal').modal('hide');
                                });
                            }
                        });
                    });

            // Resetear modal crear una vez que se cierra
                $('#creaMantenimientoModal').on('hidden.bs.modal', function() {
                    $('#formMantenimiento')[0].reset();
                });

            // Eliminar vehiculo Ajax request.
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
                        url: "mantenimientos/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#mantenimientos-table').DataTable().ajax.reload();
                                $('#DeleteProductModal').modal('hide');
                            });
                        }
                    });
                });

        });

    });

</script>
@endpush
