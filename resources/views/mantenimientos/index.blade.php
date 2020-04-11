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
                                <a href=" {{ route('mantenimientos.reportes') }} " class="btn btn-sm btn-info">
                                    <i class="fas fa-fw fa-file-alt"></i>
                                    Reporte
                                </a>
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

<!-- Modal Crear -->
    <div class="modal fade" id="creaMantenimientoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Mantenimiento</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formMantenimiento" method="POST" action="{{ route('mantenimientos.store') }}" enctype="multipart/form-data">
                            @csrf
                            {{-- Ficha --}}
                                <div class="form-group row">
                                    <label for="ficha" class="col-md-3 text-md-right">Numero de Ficha</label>
                                    <div class="col-md-8">
                                        <input id="ficha" type="text" pattern="[0-9]{7}" class="form-control" name="ficha" required autocomplete="ficha" autofocus>
                                    </div>
                                </div>

                            {{-- Placa del Vehiculo --}}
                                <div class="form-group row">

                                    <label for="placa" class="col-md-3 text-md-right">Placa del Vehiculo</label>

                                    <div class="col-md-8">
                                        <input id="placa" type="text" class="form-control" name="placa" required autocomplete="placa" autofocus>
                                    </div>
                                </div>

                            {{-- Observacion --}}
                                <div class="form-group row">
                                    <label for="observacion" class="col-md-3 text-md-right">Observacion</label>
                                    <div class="col-md-8">
                                        <textarea id="observacion" type="text" class="form-control" name="observacion" required autocomplete="observacion" autofocus></textarea>
                                    </div>
                                </div>

                            {{-- Diagnostico --}}
                                <div class="form-group row">
                                    <label for="diagnostico" class="col-md-3 text-md-right">Diagnostico</label>

                                    <div class="col-md-8">
                                        <textarea id="diagnostico" type="text" class="form-control" name="diagnostico" required autocomplete="diagnostico" autofocus></textarea>
                                    </div>
                                </div>

                            {{-- Imagen de la Ficha --}}
                                <div class="form-group row">
                                    <label for="file" class="col-md-3 text-md-right">Cargar Imagen de la Ficha</label>
                                    <div class="col-md-8">
                                        <input id="file" type="file" name="file">
                                    </div>
                                </div>
                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formMantenimiento" id="submitBtn" class="btn btn-primary">Agregar</button>
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
                        { data: 'codigo', name: 'codigo' },
                        { data: 'placa', name: 'placa' },
                        { data: 'fecha_ingreso', name: 'fecha_ingreso' },
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
                $("#btnCrearMantenimiento").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaMantenimientoModal").modal("show");
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
