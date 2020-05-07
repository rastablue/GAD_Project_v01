@extends('layouts.app')

@section('content')
<!-- Tabla -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><h4 class="m-0 font-weight-bold text-primary">Clientes</h4></span>
            <div class="group">
                @can('clientes.create')
                    <a href=" {{ route('clientes.create') }} " class="btn btn-sm btn-success">
                        <i class="fas fa-fw fa-plus"></i>
                        Nuevo Cliente
                    </a>
                @endcan
                @can('clientes.show')
                    <a href=" {{ route('clientes.reportes') }} " class="btn btn-sm btn-info" target="_blank">
                        <i class="fas fa-fw fa-file-alt"></i>
                        Reporte
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="clientes-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="75px">Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>E-mail</th>
                            <th width="255">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

<!-- Modal Crear-->
    <div class="modal fade" id="creaClienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Clientes</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formCliente" method="POST" action="{{ route('clientes.store') }}">
                            @csrf

                            {{-- cedula --}}
                                <div class="form-group row">
                                    <label for="cedula" class="col-md-3 col-form-label">Cedula</label>

                                    <div class="col-md-9">
                                        <input id="cedula" type="text" pattern="[0-9]{10}" class="form-control" name="cedula" required autocomplete="cedula" autofocus>
                                    </div>
                                </div>

                            {{-- Nombre --}}
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Nombre</label>

                                    <div class="col-md-9">
                                        <input id="name" type="text" pattern="[A-Za-z]{1,25}" class="form-control" name="name" required autocomplete="name" autofocus>
                                    </div>
                                </div>

                            {{-- Apellido Paterno --}}
                                <div class="form-group row">
                                    <label for="apellido_pater" class="col-md-3 col-form-label">Apellido Paterno</label>

                                    <div class="col-md-9">
                                        <input id="apellido_pater" type="text" pattern="[A-Za-z ]{1,25}" class="form-control" name="apellido_pater" required autocomplete="apellido_pater" autofocus>
                                    </div>
                                </div>

                            {{-- Apellido Materno --}}
                                <div class="form-group row">

                                    <label for="apellido_mater" class="col-md-3 col-form-label">Apellido Materno</label>

                                    <div class="col-md-9">
                                        <input id="apellido_mater" type="text" pattern="[A-Za-z]{1,25}" class="form-control" name="apellido_mater" required autocomplete="apellido_mater" autofocus>
                                    </div>
                                </div>

                            {{-- Direccion --}}
                                <div class="form-group row">
                                    <label for="direc" class="col-md-3 col-form-label">Direccion</label>

                                    <div class="col-md-9">
                                        <input id="direc" type="text" class="form-control" name="direc" required autocomplete="direc" autofocus>
                                    </div>
                                </div>

                            {{-- Telefono --}}
                                <div class="form-group row">
                                    <label for="tlf" class="col-md-3 col-form-label">Telefono</label>

                                    <div class="col-md-9">
                                        <input id="tlf" type="text" pattern="[0-9]{7,10}" class="form-control" name="tlf" required autocomplete="tlf" autofocus>
                                    </div>
                                </div>

                            {{-- Email --}}
                                <div class="form-group row">
                                    <label for="email" class="col-md-3 col-form-label">E-Mail Address</label>

                                    <div class="col-md-9">
                                        <input id="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" name="email" required autocomplete="email">
                                    </div>
                                </div>
                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formCliente" id="submitBtn" class="btn btn-primary">Agregar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- Delete Modal -->
    <div class="modal fade" id="DeleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5><b>Eliminar Cliente</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">Eliminar a este cliente tambien eliminara los vehiculos y los mantenimientos relacionados al mismo. <br> ¿Desea continuar?</h6>
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
                var table = $("#clientes-table").DataTable({
                    serverSide: true,
                    pageLength: 10,
                    ajax: '{!! route('datatables.clientes') !!}',
                    columns: [
                        { data: 'cedula', name: 'cedula' },
                        { data: 'name', name: 'name' },
                        { data: 'apellido_pater', name: 'apellido_pater' },
                        //{ data: 'apellido_pater', render: function(data, type, row, meta){return row.name + ' ' + row.apellido_pater}},
                        { data: 'tlf', name: 'tlf'  },
                        { data: 'email', name: 'email'  },
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
                $("#btnCrearCliente").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaClienteModal").modal("show");
                });

            // Resetear modal crear una vez que se cierra
                $('#creaClienteModal').on('hidden.bs.modal', function() {
                    $('#formCliente')[0].reset();
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
                        url: "clientes/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#clientes-table').DataTable().ajax.reload();
                                $('#DeleteProductModal').modal('hide');
                            });
                        }
                    });
                });
        });

    });

</script>
@endpush
