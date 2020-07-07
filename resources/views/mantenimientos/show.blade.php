@extends('layouts.app')

@section('content')

<form id="formmantenimiento" method="POST" action="{{ route('mantenimientos.store') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10">
            @can('solicitudes.show')

                <!-- Formulario Solicitudes -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardSolicitud" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <div class="form-row">
                                    <h6 class="font-weight-bold text-primary">
                                        Datos del Mantenimiento:
                                        <h6 class="m-0 font-weight-bold text-dark">
                                            &nbsp;&nbsp;{{ $mantenimiento->codigo }}
                                        </h6>
                                    </h6>
                                </div>
                            </a>

                        <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardSolicitud">
                                <div class="card-body">

                                    {{-- Cuerpo Formulario--}}

                                        {{-- Estados de la solicitud y Botones--}}
                                            <div class="form-row">
                                                @if ($mantenimiento->estado === 'En espera')
                                                    <div class="form-row">
                                                        <h5><span class="badge badge-info ml-2">{{ $mantenimiento->estado }}</span>&nbsp;</h5>
                                                        <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                            title="Estado del mantenimiento">?</a>
                                                    </div>
                                                @endif
                                                @if ($mantenimiento->estado === 'Activo')
                                                    <div class="form-row">
                                                        <h5><span class="badge badge-success ml-2">{{ $mantenimiento->estado }}</span></h5>
                                                        <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                        title="Estado del mantenimiento">?</a>
                                                    </div>
                                                @endif
                                                @if ($mantenimiento->estado === 'Finalizado')
                                                    <div class="form-row">
                                                        <h5><span class="badge badge-success ml-2">{{ $mantenimiento->estado }}</span></h5>
                                                        <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                                title="Estado del mantenimiento">?</a>
                                                    </div>
                                                @endif
                                                @if ($mantenimiento->estado === 'Inactivo')
                                                    <div class="form-row">
                                                        <h5><span class="badge badge-warning ml-2">{{ $mantenimiento->estado }}</span></h5>
                                                        <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                                title="Estado del mantenimiento">?</a>
                                                    </div>
                                                @endif
                                            
                                                {{-- btns --}}
                                                @if ($mantenimiento->estado != 'Finalizado')
                                                    <div class="form-group row mb-0" style="margin-left: auto;">
                                                        <div class="col-md-12">
                                                            <a href="{{ route('mantenimientos.index') }}" class="btn btn-sm btn-primary">
                                                                <i class="far fa-arrow-alt-circle-left"></i>
                                                                Volver
                                                            </a>
                                                            @can('mantenimientos.edit')
                                                                <a href="{{ route('mantenimientos.pdf', Hashids::encode($mantenimiento->id)) }}" class="btn btn-sm btn-info">
                                                                    <i class="fas fa-fw fa-file-alt"></i>
                                                                    PDF
                                                                </a>
                                                            @endcan
                                                            @can('mantenimientos.edit')
                                                                <a href="{{ route('mantenimientos.edit', Hashids::encode($mantenimiento->id)) }}" class="btn btn-sm btn-warning">
                                                                    <i class="fas fa-fw fa-pen"></i>
                                                                    Editar
                                                                </a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="form-group row mb-0" style="margin-left: auto;">
                                                        <div class="col-md-12">
                                                            <a href="{{ route('mantenimientos.index') }}" class="btn btn-sm btn-primary">
                                                                <i class="far fa-arrow-alt-circle-left"></i>
                                                                Volver
                                                            </a>
                                                            @can('mantenimientos.edit')
                                                                <a href="{{ route('mantenimientos.pdf', Hashids::encode($mantenimiento->id)) }}" class="btn btn-sm btn-info">
                                                                    <i class="fas fa-fw fa-file-alt"></i>
                                                                    PDF
                                                                </a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        <br>

                                        {{-- Codigo, Funcionario Contribuyente y Solicitante--}}
                                            <div class="form-row">
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail4"><strong>Mantenimiento:</strong></label>
                                                    <input id="codigo" type="text" class="form-control" disabled value=" {{ $mantenimiento->codigo }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                                <div class="form-group col-md-2" style="margin-left: auto;">
                                                    <label for="inputEmail4"><strong>V. Total:</strong></label>
                                                    <input id="codigo" type="text" class="form-control bg-info text-light" disabled value=" {{ $mantenimiento->valor_total }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail4"><strong>Maquinaria:</strong></label>
                                                    <input id="codigo" type="text" class="form-control" disabled value=" {{ $mantenimiento->maquinarias->codigo_nro_gad }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                                <div class="form-group">
                                                    <a href="{{ route('maquinarias.show', Hashids::encode($mantenimiento->maquinarias->id)) }}" 
                                                        class="boton text-dark" style="margin-top: 40px; background-color: #24bcf8;" 
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Ver los datos de esta maquinaria" target="_blank">

                                                        <i class="fas fa-fw fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
                                            
                                        {{-- Fechas --}}
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4"><strong>Fecha de Ingreso:</strong></label>
                                                    <input id="codigo" type="text" class="form-control" disabled value="{{ $mantenimiento->fecha_ingreso }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-row">
                                                        <label for="inputEmail4"><strong>Fecha de Egreso:</strong></label>
                                                        <input id="codigo" type="text" class="form-control" disabled value="{{ $mantenimiento->fecha_egreso }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>

                                        {{-- Observaciones y Detalles --}}
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity"><strong>Diagnostico:</strong></label>
                                                    <textarea id="detalle" type="text" class="form-control" disabled placeholder=" {{ $mantenimiento->diagnostico }}" name="detalle" required autocomplete="detalle" autofocus></textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputState"><strong>Observacion:</strong></label>
                                                    <textarea id="obsservacion" type="text" class="form-control" disabled placeholder=" {{ $mantenimiento->observacion }}" name="observacion"></textarea>
                                                </div>
                                            </div>
                                            <br>

                                </div>
                            </div>
                    </div>
            @endcan
        </div>
    </div>
</form>
@stop

@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $(function() {
        $(document).ready(function(){
            // modal crear
                $("#btnVerArchivo").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#verArchivoModal").modal("show");
                });

        });

    });

</script>
@endpush
