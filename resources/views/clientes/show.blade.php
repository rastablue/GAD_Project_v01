@extends('layouts.app')

@section('content')

<form id="formSolicitud" method="POST" action="{{ route('solicituds.store') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('clientes.show')
                <!-- Formulario Clientes -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardCliente" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="font-weight-bold text-primary">
                                    Datos del Cliente:
                                    <h6 class="m-0 font-weight-bold text-dark">
                                        {{ $cliente->name }}  {{ $cliente->apellido_pater }}  {{ $cliente->apellido_mater }}
                                    </h6>
                                </h6>
                            </a>
                        <!-- Card Content - Collapse -->
                            <div class="collapse hide" id="collapseCardCliente">
                                <div class="card-body">

                                    {{-- Cedula --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Cedula del solicitante</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" pattern="[0-9]{10}" class="form-control" disabled value="{{ $cliente->cedula }}" name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Nombre--}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Nombre del solicitante</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" pattern="[A-Za-z]{1,25}" class="form-control" disabled value="{{ $cliente->name }} {{ $cliente->apellido_pater }} {{ $cliente->apellido_mater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Direccion --}}
                                        <div class="form-group row">
                                            <label for="direc" class="col-md-4 col-form-label text-md-right">Direccion</label>

                                            <div class="col-md-6">
                                                <input id="direc" type="text" class="form-control" disabled value="{{ $cliente->direc }}" name="direc" required autofocus>
                                            </div>
                                        </div>

                                    {{-- Telefono --}}
                                        <div class="form-group row">
                                            <label for="tlf" class="col-md-4 col-form-label text-md-right">Telefono</label>

                                            <div class="col-md-6">
                                                <input id="tlf" type="text" pattern="[0-9]{7,10}" class="form-control" disabled value="{{ $cliente->tlf }}" name="tlf" required autofocus>
                                            </div>
                                        </div>

                                    {{-- Email --}}
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" disabled value="{{ $cliente->email }}" name="email" required autofocus>
                                            </div>
                                        </div>

                                    {{-- btn--}}
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-6">
                                                @can('clientes.edit')
                                                    <a href="{{ route('clientes.edit', Hashids::encode($cliente->id)) }}" class="btn btn-sm btn-warning">
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
            @can('solicitudes.show')
                <!-- Formulario Solicitudes -->

                    @if ($cliente->solicituds->first())

                        <!-- Divider -->
                            <div class="sidebar-heading text-center">
                                Solicitudes
                            </div>
                            <hr class="sidebar-divider">

                        <div class="row">
                            @foreach ($cliente->solicituds as $item)

                                <div class="col-lg-6">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Accordion -->
                                            <a href="#collapseCardSolicitud{{ $loop->iteration }}" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                <h6 class="font-weight-bold text-primary">
                                                    Datos de la Solicitud:
                                                    <h6 class="m-0 font-weight-bold text-dark">
                                                        {{ $item->codigo_solicitud }}
                                                    </h6>
                                                </h6>
                                            </a>
                                        <!-- Card Content - Collapse -->
                                            <div class="collapse hide" id="collapseCardSolicitud{{ $loop->iteration }}">
                                                <div class="card-body">

                                                    {{-- Codigo --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo</label>
                                                                <div class="col-md-6">
                                                                    <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value=" {{ $item->codigo_solicitud }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                </div>
                                                            </div>

                                                    {{-- Fecha Emision --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Emision</label>
                                                                <div class="col-md-6">
                                                                    <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value=" {{ $item->fecha_emision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                </div>
                                                            </div>

                                                    {{-- Fecha Revision --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Revision</label>
                                                                <div class="col-md-6">
                                                                    <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value=" {{ $item->fecha_revision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                </div>
                                                            </div>

                                                    {{-- Funcionario que la creo --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Funcionario contribuyente</label>
                                                                <div class="col-md-6">
                                                                    <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value="{{ $item->users->name }}  {{ $item->users->apellido_pater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                                </div>
                                                            </div>

                                                    {{-- Detalle --}}
                                                            <div class="form-group row">
                                                                <label for="detalle" class="col-md-4 col-form-label text-md-right">Detalle</label>
                                                                <div class="col-md-6">
                                                                    <textarea id="detalle" type="text" class="form-control" disabled placeholder=" {{ $item->detalle }}" name="detalle" required autocomplete="detalle" autofocus></textarea>
                                                                </div>
                                                            </div>

                                                    {{-- Estado --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado Solicitud</label>
                                                                <div class="col-md-6">
                                                                    <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value="{{ $item->estado }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                                </div>
                                                            </div>

                                                    {{-- btn--}}
                                                        @if($item->estado != 'Reprobado')
                                                            <div class="form-group row mb-0">
                                                                <div class="col-md-6 offset-md-5">
                                                                    @can('solicitudes.show')
                                                                        <a href="{{ route('solicituds.show', Hashids::encode($item->id)) }}" class="btn btn-sm btn-info">
                                                                            <i class="fas fa-fw fa-eye"></i>
                                                                            Ver
                                                                        </a>
                                                                    @endcan
                                                                    @can('solicitudes.edit')
                                                                        <a href="{{ route('solicituds.edit', Hashids::encode($item->id)) }}" class="btn btn-sm btn-warning">
                                                                            <i class="fas fa-fw fa-pen"></i>
                                                                            Editar
                                                                        </a>
                                                                    @endcan
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="form-group row mb-0">
                                                                <div class="col-md-6 offset-md-5">
                                                                    @can('solicitudes.show')
                                                                        <a href="{{ route('solicituds.show', Hashids::encode($item->id)) }}" class="btn btn-sm btn-info">
                                                                            <i class="fas fa-fw fa-eye"></i>
                                                                            Ver
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
                        </div>

                    @endif

            @endcan
        </div>
    </div>
</form>

@endsection
