@extends('layouts.app')

@section('table')
<!-- Tabla -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><h4 class="m-0 font-weight-bold text-primary">Funcionarios Publicos</h4></span>
            <div class="group">
                @can('users.create')
                    <a href=" {{ route('users.create') }} " class="btn btn-sm btn-success">
                        <i class="fas fa-fw fa-plus"></i>
                        Nuevo Funcionario
                    </a>
                @endcan
                @can('users.show')
                    <a href=" {{ route('users.reportes') }} " class="btn btn-sm btn-info" target="_blank">
                        <i class="fas fa-fw fa-file-alt"></i>
                        Reporte
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
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
    <div class="modal fade" id="creaUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Funcionario</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formUser" method="POST" action="{{ route('users.store') }}">
                            @csrf

                            {{-- cedula --}}
                                <div class="form-group row">
                                    <label for="cedula" class="col-md-3 col-form-label">Cedula</label>

                                    <div class="col-md-9">
                                        <input id="cedula" name="cedula" type="text" pattern="[0-9]{10}" class="form-control" required autocomplete="cedula" autofocus>
                                    </div>
                                </div>

                            {{-- Nombre --}}
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Nombre</label>

                                    <div class="col-md-9">
                                        <input id="name" name="name" type="text" pattern="[A-Za-z]{1,25}" class="form-control" required autocomplete="name" autofocus>
                                    </div>
                                </div>

                            {{-- Apellido Paterno --}}
                                <div class="form-group row">
                                    <label for="apellido_pater" class="col-md-3 col-form-label">Apellido Paterno</label>

                                    <div class="col-md-9">
                                        <input id="apellido_pater" name="apellido_pater" type="text" pattern="[A-Za-z ]{1,25}" class="form-control" required autocomplete="apellido_pater" autofocus>
                                    </div>
                                </div>

                            {{-- Apellido Materno --}}
                                <div class="form-group row">

                                    <label for="apellido_mater" class="col-md-3 col-form-label">Apellido Materno</label>

                                    <div class="col-md-9">
                                        <input id="apellido_mater" name="apellido_mater" type="text" pattern="[A-Za-z]{1,25}" class="form-control" required autocomplete="apellido_mater" autofocus>
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

                            {{-- Email --}}
                                <div class="form-group row">
                                    <label for="email" class="col-md-3 col-form-label">E-Mail Address</label>

                                    <div class="col-md-9">
                                        <input id="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" name="email" required autocomplete="email">
                                    </div>
                                </div>

                            {{-- Password --}}
                                <div class="form-group row">
                                    <label for="password" class="col-md-3 col-form-label">Password</label>

                                    <div class="col-md-9">
                                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                    </div>
                                </div>

                            {{-- Confirm Password --}}
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-3 col-form-label">Confirm Password</label>

                                    <div class="col-md-9">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formUser" id="submitBtn" class="btn btn-primary">Agregar</button>
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
                        <h5><b>Eliminar Usuario</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">Eliminar este usuario tambien eliminara a todos los empleados vinculados. <br> ¿Desea continuar?</h6>
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
                var table = $("#users-table").DataTable({
                    serverSide: true,
                    pageLength: 10,
                    ajax: '{!! route('datatables.users') !!}',
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
                $("#btnCrearUser").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaUserModal").modal("show");
                });

           // Resetear modal crear una vez que se cierra
                $('#creaUserModal').on('hidden.bs.modal', function() {
                        $('#formUser')[0].reset();
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
                        url: "users/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#users-table').DataTable().ajax.reload();
                                $('#DeleteProductModal').modal('hide');
                            });
                        }
                    });
                });

       });
   });
</script>
@endpush
@push('charts')
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June"],
                datasets: [{
                    label: "Revenue",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: [4215, 5312, 6251, 7841, 9821, 14984],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        },
                        maxBarThickness: 25,
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 15000,
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '$' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                        }
                    }
                },
            }
        });
</script>
@endpush
