@extends('layouts.app')

@section('content')

<form id="formSolicitud" method="POST" action="{{ route('solicituds.store') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('mantenimientos.show')
                <!-- Formulario Mantenimientos -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardMantenimiento" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="font-weight-bold text-primary">
                                    Datos Del Mantenimiento:
                                    <h6 class="m-0 font-weight-bold text-dark">
                                        {{ $mantenimiento->codigo }}
                                    </h6>
                                </h6>
                            </a>
                        <!-- Card Content - Collapse -->
                            <div class="collapse hide" id="collapseCardMantenimiento">
                                <div class="card-body">

                                    {{-- Codigo --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Mantenimiento</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $mantenimiento->codigo }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                            </div>
                                        </div>

                                    {{-- Fecha Ingreso --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha Ingreso</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $mantenimiento->fecha_ingreso }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                            </div>
                                        </div>

                                    {{-- Fecha Egreso --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha Egreso</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $mantenimiento->fecha_egreso }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                            </div>
                                        </div>

                                    {{-- Observacion --}}
                                        <div class="form-group row">
                                            <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                            <div class="col-md-6">
                                                <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $mantenimiento->observacion }} </textarea>
                                            </div>
                                        </div>

                                    {{-- Diagnostico --}}
                                        <div class="form-group row">
                                            <label for="detalle" class="col-md-4 col-form-label text-md-right">Diagnostico</label>
                                            <div class="col-md-6">
                                                <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $mantenimiento->diagnostico }} </textarea>
                                            </div>
                                        </div>

                                    {{-- Estado --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $mantenimiento->estado }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                            </div>
                                        </div>

                                    {{-- Valor Total --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Valor Total</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $mantenimiento->valor_total }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                            </div>
                                        </div>

                                    {{-- btn --}}
                                        @if ($mantenimiento->estado != 'Finalizado')
                                            <div class="form-group row mb-0">
                                                <div class="align-maquinarias-center col-md-6 offset-md-5">
                                                    @can('mantenimientos.show')
                                                        <button type="button" id="btnVerArchivo" class="btn btn-success btn-sm">
                                                            <i class="fas fa-fw fa-image"></i>
                                                            Archivo
                                                        </button>
                                                    @endcan
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
                                            <div class="form-group row mb-0">
                                                <div class="align-maquinarias-center col-md-6 offset-md-6">
                                                    @can('mantenimientos.show')
                                                        <button type="button" id="btnVerArchivo" class="btn btn-success btn-sm">
                                                            <i class="fas fa-fw fa-image"></i>
                                                            Archivo
                                                        </button>
                                                    @endcan
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
                            </div>
                    </div>
            @endcan
            @can('maquinarias.show')
                <!-- Formulario Vehiculo -->
                    @if (@$mantenimiento->maquinarias)
                        <!-- Divider -->
                            <div class="sidebar-heading text-center">
                                Maquinaria
                            </div>
                            <hr class="sidebar-divider">
                        <!-- Body -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                        <a href="#collapseCardMaquinaria" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <h6 class="font-weight-bold text-primary">
                                                Datos De La Maquinaria:
                                                <h6 class="m-0 font-weight-bold text-dark">
                                                    {{ $mantenimiento->maquinarias->codigo_nro_gad }}
                                                </h6>
                                            </h6>
                                        </a>
                                <!-- Card Content - Collapse -->
                                    <div class="collapse hide" id="collapseCardMaquinaria">
                                        <div class="card-body">

                                            {{-- Codigo GAD --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo GAD</label>
                                                        <div class="col-md-6">
                                                            <input type="input" disabled value="{{ $mantenimiento->maquinarias->codigo_nro_gad }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                        </div>
                                                    </div>

                                            {{-- Placa --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Placa</label>
                                                        <div class="col-md-6">
                                                            <input type="input" disabled value="{{ $mantenimiento->maquinarias->placa }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                        </div>
                                                    </div>

                                            {{-- Marca --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Marca</label>
                                                        <div class="col-md-6">
                                                            <input type="input" disabled value="{{ $mantenimiento->maquinarias->marcas->marca }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                        </div>
                                                    </div>

                                            {{-- Modelo --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Modelo</label>
                                                        <div class="col-md-6">
                                                            <input type="input" disabled value="{{ $mantenimiento->maquinarias->anio }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                        </div>
                                                    </div>

                                            {{-- Año --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Año</label>
                                                        <div class="col-md-6">
                                                            <input type="input" disabled value="{{ $mantenimiento->maquinarias->anio }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                        </div>
                                                    </div>

                                            {{-- Tipo --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Tipo</label>
                                                        <div class="col-md-6">
                                                            <input type="input" disabled value="{{ $mantenimiento->maquinarias->tipo_vehiculo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                        </div>
                                                    </div>

                                            {{-- Observacion --}}
                                                    <div class="form-group row">
                                                        <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                        <div class="col-md-6">
                                                            <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $mantenimiento->maquinarias->observacion }} </textarea>
                                                        </div>
                                                    </div>

                                            {{-- btn--}}
                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-6 offset-md-6">
                                                            @can('maquinarias.show')
                                                                <a href="{{ route('maquinarias.show', Hashids::encode($mantenimiento->maquinarias->id)) }}" class="btn btn-sm btn-info">
                                                                    <i class="fas fa-fw fa-eye"></i>
                                                                    Ver
                                                                </a>
                                                            @endcan
                                                            @can('maquinarias.edit')
                                                                <a href="{{ route('maquinarias.edit', Hashids::encode($mantenimiento->maquinarias->id)) }}" class="btn btn-sm btn-warning">
                                                                    <i class="fas fa-fw fa-pen"></i>
                                                                    Editar
                                                                </a>
                                                            @endcan
                                                        </div>
                                                    </div>

                                        </div>
                                    </div>
                            </div>
                    @endif

            @endcan
            @can('trabajos.show')
                <!-- Formulario Trabajos -->

                    <!-- Divider -->
                        <div class="sidebar-heading text-center">
                            Trabajos
                        </div>
                        <hr class="sidebar-divider">

                    <div class="row">
                        @if(@$mantenimiento->trabajos->first())

                            <!-- Body -->

                                @foreach (@$mantenimiento->trabajos as $item)

                                    <div class="col-lg-6">
                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Accordion -->
                                                    <a href="#collapseCardTrabajos{{$loop->iteration}}" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                        <h6 class="m-0 font-weight-bold text-primary">
                                                            Datos Del Trabajo:
                                                            <h6 class="m-0 font-weight-bold text-dark"><i>{{ $item->fake_id}}</i></h6>
                                                        </h6>
                                                    </a>
                                            <!-- Card Content - Collapse -->
                                                    <div class="collapse hide" id="collapseCardTrabajos{{ $loop->iteration}}">
                                                        <div class="card-body">

                                                            {{-- Codigo Trabajo --}}
                                                                <div class="form-group row">
                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Tarea</label>
                                                                    <div class="col-md-6">
                                                                        <input type="input" disabled value="{{ $item->fake_id }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                    </div>
                                                                </div>

                                                            {{-- Mano de Obra --}}
                                                                <div class="form-group row">
                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Mano De Obra</label>
                                                                    <div class="col-md-6">
                                                                        <textarea type="text" disabled class="form-control" required autocomplete="direccion" autofocus> {{ $item->manobra }} </textarea>
                                                                    </div>
                                                                </div>

                                                            {{-- Repuestos --}}
                                                                <div class="form-group row">
                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Repuestos</label>
                                                                    <div class="col-md-6">
                                                                        <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->repuestos }} </textarea>
                                                                    </div>
                                                                </div>

                                                            {{-- Costo Mano De Obra --}}
                                                                <div class="form-group row">
                                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Costo De Mano De Obra</label>
                                                                    <div class="col-md-6">
                                                                        <input type="input" disabled value="{{ $item->costo_manobra }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                    </div>
                                                                </div>

                                                            {{-- Costo Repuestos --}}
                                                                <div class="form-group row">
                                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Costo De Repuestos</label>
                                                                    <div class="col-md-6">
                                                                        <input type="input" disabled value="{{ $item->costo_repuestos }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                    </div>
                                                                </div>

                                                            {{-- Estado --}}
                                                                <div class="form-group row">
                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado</label>
                                                                    <div class="col-md-6">
                                                                        <input type="input" disabled value="{{ $item->estado }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                    </div>
                                                                </div>

                                                            {{-- Tipo --}}
                                                                <div class="form-group row">
                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Tipo De Mantenimiento</label>
                                                                    <div class="col-md-6">
                                                                        <input type="input" disabled value="{{ $item->tipo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                    </div>
                                                                </div>

                                                            {{-- btn--}}
                                                                @if ($item->estado != 'Finalizado')
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-6 offset-md-5">
                                                                            @can('tareas.edit')
                                                                                <a href="{{ route('trabajos.edit', Hashids::encode($item->id)) }}" class="btn btn-sm btn-warning">
                                                                                    <i class="fas fa-fw fa-pen"></i>
                                                                                    Editar
                                                                                </a>
                                                                            @endcan
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                        </div>
                                                    </div>
                                        </div>
                                    </div>

                                @endforeach

                        @endif

                        <!-- Boton Agregar Nuevo Trabajo -->
                            @if ($mantenimiento->estado != 'Finalizado')
                                <div class="col-lg-6">
                                    <div class="row justify-content-center">
                                        @can('trabajos.create')
                                            <a href="{{ route('trabajos.createfrom', Hashids::encode($mantenimiento->id)) }}">
                                                <img class="img-responsive img-rounded float-left" src="{{ asset('images/plus.png') }}" title="Agregar Trabajo">
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            @endif

                    </div>


            @endcan
        </div>
    </div>
</form>
<!-- Modal Ver Archivo -->
    <div class="modal fade" id="verArchivoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                @if ($mantenimiento->path)
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Archivo de Ficha</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <img class="img-responsive img-rounded" src="{{ $mantenimiento->url_path }}">
                @else
                    <div class="card-body">
                        <h5>No se ha encontrado el archivo!</h5>
                        @can('mantenimientos.edit')
                            <h5><a href="{{ route('mantenimientos.edit', Hashids::encode($mantenimiento->id)) }}">cargar...</a></h5>
                        @endcan
                    </div>
                @endif

            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
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
