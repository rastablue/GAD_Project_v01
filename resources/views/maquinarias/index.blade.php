@extends('layouts.app')

@section('table')
<!-- Tabla -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><h4 class="m-0 font-weight-bold text-primary">Vehiculos</h4></span>
            <div class="group">
                @can('maquinarias.create')
                    <button type="button" id="btnCrearMaquinaria" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i>
                        Nuevo Vehiculo
                    </button>
                @endcan
                @can('maquinarias.show')
                    <a href="{{ route('maquinarias.reportes') }}" class="btn btn-sm btn-info">
                        <i class="fas fa-fw fa-file-alt"></i>
                        Reporte
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="maquinarias-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="100px">Codigo GAD</th>
                            <th>Placa</th>
                            <th>Modelo</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


<!-- Modal Crear-->
    <div class="modal fade" id="creaMaquinariaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Vehiculo</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formMaquinaria" method="POST" action="{{ route('maquinarias.store') }}">
                            @csrf

                            {{-- Codigo GAD --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo GAD</label>
                                    <div class="col-md-6">
                                        <input type="input" id="codigo" name="codigo" class="form-control" required autocomplete="codigo" autofocus>
                                    </div>
                                </div>

                            {{-- Placa --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Placa</label>
                                    <div class="col-md-6">
                                        <input type="input" id="placa" name="placa" class="form-control" required autocomplete="placa" autofocus>
                                    </div>
                                </div>

                            {{-- Marca --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Marca</label>
                                    <div class="col-md-6">
                                        <select id="marca" class="form-control" name="marca" required>
                                            <option disabled selected='true'>Seleccione una Marca</option>
                                            @foreach(App\Marca::all() as $marcas)
                                                <option value="{{ $marcas->id }}">  {{ $marcas->marca }}  </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            {{-- Modelo --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Modelo</label>
                                    <div class="col-md-6">
                                        <input type="input" id="modelo" name="modelo" class="form-control" required autocomplete="modelo" autofocus>
                                    </div>
                                </div>

                            {{-- Año --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Año</label>
                                    <div class="col-md-6">
                                        <input type="number" id="anio" name="anio" pattern="{4}" class="form-control" required autocomplete="anio" autofocus>
                                    </div>
                                </div>

                            {{-- Kilometraje --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Kilometraje</label>
                                    <div class="col-md-6">
                                        <input type="number" name="kilometraje" class="form-control" required autocomplete="kilometraje" autofocus>
                                    </div>
                                </div>

                            {{-- Tipo --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Tipo</label>
                                    <div class="col-md-6">
                                        <input type="input" id="tipo" name="tipo" class="form-control" required autocomplete="tipo" autofocus>
                                    </div>
                                </div>

                            {{-- Observacion --}}
                                <div class="form-group row">
                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                    <div class="col-md-6">
                                        <textarea type="text" id="observacion" name="observacion" class="form-control" autocomplete="observacion" autofocus></textarea>
                                    </div>
                                </div>

                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formMaquinaria" id="submitBtn" class="btn btn-primary">Agregar</button>
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
                        <h6 align="center">Eliminar este vehiculo tambien lo desvinculara de todas las tareas relacionas. <br> ¿Desea continuar?</h6>
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
                var table = $("#maquinarias-table").DataTable({
                    serverSide: true,
                    pageLength: 10,
                    ajax: '{!! route('datatables.maquinarias') !!}',
                    columns: [
                        { data: 'codigo_nro_gad', name: 'codigo_nro_gad' },
                        { data: 'placa', name: 'placa' },
                        { data: 'modelo', name: 'modelo'  },
                        { data: 'tipo_vehiculo', name: 'tipo_vehiculo'  },
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
                $("#btnCrearMaquinaria").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaMaquinariaModal").modal("show");
                });

            // Resetear modal crear una vez que se cierra
                $('#creaMaquinariaModal').on('hidden.bs.modal', function() {
                        $('#formMaquinaria')[0].reset();
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
                        url: "maquinarias/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#maquinarias-table').DataTable().ajax.reload();
                                $('#DeleteProductModal').modal('hide');
                            });
                        }
                    });
                });

        });

    });
</script>
@endpush
