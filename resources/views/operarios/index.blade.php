@extends('layouts.app')

@section('table')
<!-- Tabla -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><h4 class="m-0 font-weight-bold text-primary">Operarios</h4></span>
            <div class="group">
                @can('operarios.create')
                    <a href=" {{ route('operarios.create') }} " class="btn btn-sm btn-success">
                        <i class="fas fa-fw fa-plus"></i>
                        Nuevo Operario
                    </a>
                @endcan
                @can('operarios.show')
                    <a href=" {{ route('operarios.reportes') }} " class="btn btn-sm btn-info" target="_blank">
                        <i class="fas fa-fw fa-file-alt"></i>
                        Reporte
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="operarios-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="75px">Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Licencia</th>
                            <th width="255">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


<!-- Modal Crear-->
    <div class="modal fade" id="creaOperarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Operario</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formOperario" method="POST" action="{{ route('operarios.store') }}">
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
                                        <input id="direc" name="direc" type="text" class="form-control" required autocomplete="direc" autofocus>
                                    </div>
                                </div>

                            {{-- Telefono --}}
                                <div class="form-group row">
                                    <label for="tlf" class="col-md-3 col-form-label">Telefono</label>

                                    <div class="col-md-9">
                                        <input id="tlf" name="tlf" type="text" pattern="[0-9]{7,10}" class="form-control" required autocomplete="tlf" autofocus>
                                    </div>
                                </div>

                            {{-- Tipo Contrato --}}
                                <div class="form-group row">
                                    <label for="tipo_contrato" class="col-md-3 col-form-label">{{ __('Tipo de Contrato') }}</label>

                                    <div class="col-md-9">

                                        <select id="tipo_contrato" class="form-control" name="tipo_contrato">
                                            <option disabled="true" selected='true'>Seleccione un Contrato</option>
                                            @foreach(App\Operario::getEnumValues('operarios', 'tipo_contrato') as $operarios)
                                                <option value="{{ $operarios }}">  {{ $operarios}}  </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                            {{-- Tipo Licencia --}}
                                <div class="form-group row">
                                    <label for="tipo_licencia" class="col-md-3 col-form-label">{{ __('Tipo de Licencia') }}</label>

                                    <div class="col-md-9">

                                        <select id="tipo_licencia" class="form-control" name="tipo_licencia">
                                            <option disabled="true" selected='true'>Seleccione una Licencia</option>
                                            @foreach(App\Operario::getEnumValues('operarios', 'tipo_licencia') as $operarios)
                                                <option value="{{ $operarios }}">  {{ $operarios}}  </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formOperario" id="submitBtn" class="btn btn-primary">Agregar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- Modal Editar-->
    <div class="modal fade" id="EditOperarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Editar Vehiculo</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    <!-- Modal body -->
                        <div class="modal-body">
                            <div id="editaOperarioBody">

                            </div>
                        </div>
                    <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" form="formVehiculo" id="SubmitEditVehiculoForm" class="btn btn-primary">Actualizar</button>
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
                        <h5><b>Eliminar operario</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">¿Esta seguro que desea eliminar a este Operario?.</h6>
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
                var table = $("#operarios-table").DataTable({
                    serverSide: true,
                    pageLength: 10,
                    ajax: '{!! route('datatables.operarios') !!}',
                    columns: [
                        { data: 'cedula', name: 'cedula' },
                        { data: 'name', name: 'name' },
                        { data: 'apellido_pater', name: 'apellido_pater' },
                        { data: 'tlf', name: 'tlf'  },
                        { data: 'tipo_licencia', name: 'tipo_licencia'  },
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
                $("#btnCrearOperario").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaOperarioModal").modal("show");
                });

            // Resetear modal crear una vez que se cierra
                $('#creaOperarioModal').on('hidden.bs.modal', function() {
                        $('#formOperario')[0].reset();
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
                        url: "operarios/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#operarios-table').DataTable().ajax.reload();
                                $('#DeleteProductModal').modal('hide');
                            });
                        }
                    });
                });

            // Get single product in EditModel
                var id;
                    $(document).on('click', '#getEditId', function(e){
                        e.preventDefault();
                        id = $(this).data('id');
                        $.ajax({
                            url: "operarios/"+id+"/edit",
                            method: 'GET',
                            data: {
                                id: id,
                            },
                            success: function(result) {
                                console.log(result);
                                $('#editaOperarioBody').html(result.html);
                                $('#EditOperarioModal').modal('show');
                            }
                        });
                        $('.modal-body').load('content.html',function(){
                            $("#alertModal").addClass("display-none").removeClass("alert-danger")
                            $("#inputId").val(null)
                            $('#EditOperarioModal').modal('show');
                        });
                    });

        });

    });
</script>
@endpush
