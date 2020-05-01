@extends('layouts.app')

@section('content')

<form id="formSolicitud" method="POST" action="{{ route('solicituds.store') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('tareas.show')
                <!-- Formulario Tarea -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardTarea" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="font-weight-bold text-primary">
                                    Datos del Requerimiento:
                                    <h6 class="m-0 font-weight-bold text-dark">
                                        {{ $tarea->fake_id }}
                                    </h6>
                                </h6>
                            </a>
                        <!-- Card Content - Collapse -->
                            <div class="collapse hide" id="collapseCardTarea">
                                <div class="card-body">

                                    {{-- Codigo Tarea --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $tarea->fake_id }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                            </div>
                                        </div>

                                    {{-- Fecha Inicio --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Inicio</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $tarea->fecha_inicio }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                            </div>
                                        </div>

                                    {{-- Fecha Fin --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Fin</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $tarea->fecha_fin }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                            </div>
                                        </div>

                                    {{-- Direccion --}}
                                        <div class="form-group row">
                                            <label for="detalle" class="col-md-4 col-form-label text-md-right">Direccion</label>
                                            <div class="col-md-6">
                                                <textarea type="text" disabled class="form-control" required autocomplete="direccion" autofocus> {{ $tarea->direc_tarea }} </textarea>
                                            </div>
                                        </div>

                                    {{-- Detalle --}}
                                        <div class="form-group row">
                                            <label for="detalle" class="col-md-4 col-form-label text-md-right">Detalle</label>
                                            <div class="col-md-6">
                                                <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $tarea->detalle }} </textarea>
                                            </div>
                                        </div>

                                    {{-- Estado --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $tarea->estado }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                            </div>
                                        </div>

                                    {{-- btn--}}
                                        @if($tarea->estado != 'Finalizada')
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-6">
                                                    @can('tareas.edit')
                                                        <a href="{{ route('tareas.edit', Hashids::encode($tarea->id)) }}" class="btn btn-sm btn-warning">
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
            @endcan
            @can('solicitudes.show')
                <!-- Formulario Solicitud -->
                    <!-- Divider -->
                        <div class="sidebar-heading text-center">
                            Solicitud
                        </div>
                        <hr class="sidebar-divider">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardSolicitud" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="font-weight-bold text-primary">
                                    Datos de la Solicitud:
                                    <h6 class="m-0 font-weight-bold text-dark">
                                        {{ $tarea->solicituds->codigo_solicitud }}
                                    </h6>
                                </h6>
                            </a>
                        <!-- Card Content - Collapse -->
                            <div class="collapse hide" id="collapseCardSolicitud">
                                <div class="card-body">

                                    {{-- Codigo --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value=" {{ $tarea->solicituds->codigo_solicitud }} " name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Fecha Emision --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Emision</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value=" {{ $tarea->solicituds->fecha_emision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Fecha Revision --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Revision</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value=" {{ $tarea->solicituds->fecha_revision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Funcionario que la creo --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Funcionario contribuyente</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value="{{ $tarea->solicituds->users->name }}  {{ $tarea->solicituds->users->apellido_pater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Detalle --}}
                                        <div class="form-group row">
                                            <label for="detalle" class="col-md-4 col-form-label text-md-right">Detalle</label>
                                            <div class="col-md-6">
                                                <textarea id="detalle" type="text" class="form-control" disabled placeholder=" {{ $tarea->solicituds->detalle }}" name="detalle" required autocomplete="detalle" autofocus></textarea>
                                            </div>
                                        </div>

                                    {{-- Estado --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado Solicitud</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value="{{ $tarea->solicituds->estado }}" name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- btn--}}
                                        @if($tarea->solicituds->estado != 'Reprobado')
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-6">
                                                    @can('solicitudes.show')
                                                        <a href="{{ route('solicituds.show', Hashids::encode($tarea->solicituds->id)) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-fw fa-eye"></i>
                                                            Ver
                                                        </a>
                                                    @endcan
                                                    @can('solicitudes.edit')
                                                        <a href="{{ route('solicituds.edit', Hashids::encode($tarea->solicituds->id)) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-fw fa-pen"></i>
                                                            Editar
                                                        </a>
                                                    @endcan
                                                </div>
                                            </div>
                                        @else
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-6">
                                                    @can('solicitudes.show')
                                                        <a href="{{ route('solicituds.show', Hashids::encode($tarea->solicituds->id)) }}" class="btn btn-sm btn-info">
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
            @endcan
            @can('maquinarias.show')
                <!-- Formulario Maquinarias -->
                    <!-- Divider -->
                        <div class="sidebar-heading text-center">
                            Maquinarias
                        </div>
                        <hr class="sidebar-divider">

                    <div class="row">

                        @if(@$tarea->maquinarias->first())
                            @foreach (@App\Tarea::findOrFail($tarea->id)->maquinarias as $item)

                                <div class="col-lg-6">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Accordion -->
                                            @if (!$item->operario_id)
                                                <a href="#collapseCardTareas{{ $loop->iteration}}" class="d-block card-header py-3 border-left-danger" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                    <em>Esta maquinaria no posee un operador asignado</em>
                                                    <h6 class="font-weight-bold text-danger">
                                                        Datos de la Maquinaria:
                                                        <h6 class="m-0 font-weight-bold text-dark">
                                                            <i>{{ $item->codigo_nro_gad}}</i>
                                                        </h6>
                                                    </h6>
                                                </a>
                                            @else
                                                <a href="#collapseCardTareas{{ $loop->iteration}}" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                    <h6 class="font-weight-bold text-primary">
                                                        Datos de la Maquinaria:
                                                        <h6 class="m-0 font-weight-bold text-dark">
                                                            <i>{{ $item->codigo_nro_gad}}</i>
                                                        </h6>
                                                    </h6>
                                                </a>
                                            @endif
                                                
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
                            @if($tarea->estado != 'Finalizada')
                                <div class="col-lg-6">
                                    <div class="row justify-content-center">
                                        @can('actividades.encargos.asignaciones')
                                            <a href="{{ route('asigna.edit', Hashids::encode($tarea->id)) }}">
                                                <img class="img-responsive img-rounded float-left" src="{{ asset('images/plus.png') }}" title="Asignar Maquinarias">
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

@endsection
