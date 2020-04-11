@extends('layouts.app')

@section('content')

<form id="formSolicitud" method="POST" action="#">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('operarios.show')
                <!-- Formulario operarios -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardOperario" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="font-weight-bold text-primary">
                                    Datos del Operario:
                                    <h6 class="m-0 font-weight-bold text-dark">
                                        {{ $operario->name }}  {{ $operario->apellido_pater }}  {{ $operario->apellido_mater }}
                                    </h6>
                                </h6>
                            </a>
                        <!-- Card Content - Collapse -->
                            <div class="collapse hide" id="collapseCardOperario">
                                <div class="card-body">

                                    {{-- Cedula --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Cedula</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value="{{ $operario->cedula }}" name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Nombre--}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value="{{ $operario->name }} {{ $operario->apellido_pater }} {{ $operario->apellido_mater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Direccion --}}
                                        <div class="form-group row">
                                            <label for="direc" class="col-md-4 col-form-label text-md-right">Direccion</label>

                                            <div class="col-md-6">
                                                <input id="direc" type="text" class="form-control" disabled value="{{ $operario->direc }}" name="direc" required autofocus>
                                            </div>
                                        </div>

                                    {{-- Telefono --}}
                                        <div class="form-group row">
                                            <label for="tlf" class="col-md-4 col-form-label text-md-right">Telefono</label>

                                            <div class="col-md-6">
                                                <input id="tlf" type="text" pattern="[0-9]{7,10}" class="form-control" disabled value="{{ $operario->tlf }}" name="tlf" required autofocus>
                                            </div>
                                        </div>

                                    {{-- Tipo Contrato --}}
                                        <div class="form-group row">
                                            <label for="tlf" class="col-md-4 col-form-label text-md-right">Tipo Contrato</label>

                                            <div class="col-md-6">
                                                <input id="tlf" type="text" pattern="[0-9]{7,10}" class="form-control" disabled value="{{ $operario->tipo_contrato }}" name="tlf" required autofocus>
                                            </div>
                                        </div>

                                    {{-- Tipo Contrato --}}
                                        <div class="form-group row">
                                            <label for="tlf" class="col-md-4 col-form-label text-md-right">Tipo Licencia</label>

                                            <div class="col-md-6">
                                                <input id="tlf" type="text" pattern="[0-9]{7,10}" class="form-control" disabled value="{{ $operario->tipo_licencia }}" name="tlf" required autofocus>
                                            </div>
                                        </div>

                                    {{-- btn--}}
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-6">
                                                @can('operarios.show')
                                                    <a href="{{ route('operarios.pdf', Hashids::encode($operario->id)) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-fw fa-file-alt"></i>
                                                        PDF
                                                    </a>
                                                @endcan
                                                @can('operarios.edit')
                                                    <a href="{{ route('operarios.edit', Hashids::encode($operario->id)) }}" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-fw fa-pen"></i>
                                                        Editar
                                                    </a>
                                                @endcan
                                            </div>
                                        </div>

                                </div>
                            </div>
                    </div>
            @endcan
            @can('maquinarias.show')
                <!-- Formularios Maquinarias -->

                    <!-- Divider -->
                        <div class="sidebar-heading text-center">
                            Maquinarias
                        </div>
                        <hr class="sidebar-divider">

                    <div class="row">

                        @if(@$operario->maquinarias->first())
                            @foreach (@$operario->maquinarias as $item)

                                <div class="col-lg-6">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Accordion -->
                                                <a href="#collapseCardTareas{{ $loop->iteration}}" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                    <h6 class="font-weight-bold text-primary">
                                                        Datos de la Maquinaria:
                                                        <h6 class="m-0 font-weight-bold text-dark">
                                                            <i>{{ $item->codigo_nro_gad}}</i>
                                                        </h6>
                                                    </h6>
                                                </a>
                                        <!-- Card Content - Collapse -->
                                                <div class="collapse hide" id="collapseCardTareas{{ $loop->iteration}}">
                                                    <div class="card-body">

                                                        {{-- Codigo GAD --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo GAD</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $item->codigo_nro_gad }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Placa --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Placa</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $item->placa }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Marca --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Marca</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $item->marcas->marca }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Modelo --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Modelo</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $item->anio }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Año --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Año</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $item->anio }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Tipo --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Tipo</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $item->tipo_vehiculo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Observacion --}}
                                                            <div class="form-group row">
                                                                <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                                <div class="col-md-6">
                                                                    <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->observacion }} </textarea>
                                                                </div>
                                                            </div>

                                                        {{-- btn--}}
                                                            <div class="form-group row mb-0">
                                                                <div class="align-items-center col-md-6 offset-md-5">
                                                                    @can('maquinarias.show')
                                                                        <a href="{{ route('maquinarias.show', Hashids::encode($item->id)) }}" class="btn btn-sm btn-info">
                                                                            <i class="fas fa-fw fa-eye"></i>
                                                                            Ver
                                                                        </a>
                                                                    @endcan
                                                                    @can('maquinarias.edit')
                                                                        <a href="{{ route('maquinarias.edit', Hashids::encode($item->id)) }}" class="btn btn-sm btn-warning">
                                                                            <i class="fas fa-fw fa-pen"></i>
                                                                            Editar
                                                                        </a>
                                                                    @endcan
                                                                </div>
                                                            </div>

                                                    </div>
                                                </div>
                                    </div>
                                </div>

                            @endforeach
                        @endif

                        <!-- Boton Agregar Nueva Tarea -->
                            <div class="col-lg-6">
                                <div class="row justify-content-center">
                                    @can('actividades.encargos.asignaciones')
                                        <a href="{{ route('asignavehi.edit', Hashids::encode($operario->id)) }}">
                                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/plus.png') }}" title="Asignar Maquinarias">
                                        </a>
                                    @endcan

                                </div>
                            </div>
                    </div>
            @endcan
        </div>
    </div>
</form>

@endsection
