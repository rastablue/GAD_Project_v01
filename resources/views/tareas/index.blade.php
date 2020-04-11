@extends('layouts.app')

@section('table')
<!-- Tabla -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><h4 class="m-0 font-weight-bold text-primary">Tareas</h4></span>
            <div class="group">
                @can('tareas.create')
                    <a href=" {{ route('tareas.create') }} " class="btn btn-sm btn-success">
                        <i class="fas fa-fw fa-plus"></i>
                        Nueva Tarea
                    </a>
                @endcan
                @can('tareas.show')
                    <a href=" {{ route('tareas.reportes') }} " class="btn btn-sm btn-info">
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
                            <th width="75px">Codigo Tarea</th>
                            <th width="75px">Codigo Solicitud</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
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
                        { data: 'fake_id', name: 'fake_id' },
                        { data: 'codigo', name: 'codigo' },
                        { data: 'fecha_inicio', name: 'fecha_inicio' },
                        { data: 'fecha_fin', name: 'fecha_fin' },
                        { data: 'estado', name: 'estado'  },
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
