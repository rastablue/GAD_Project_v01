@extends('layouts.app')

@section('content')

<form id="formSolicitud" method="POST" action="{{ route('solicituds.store') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-10">
            @can('solicitudes.show')
                @php
                    $i = 0;
                    $date = date("Y-m-d");
                @endphp

                <!-- Alert en caso de estar finalizada la tarea -->
                    @if (@$solicitud->estado === 'Finalizado')
                        @foreach ($solicitud->tareas->all() as $item)
                            @if ($item->estado === 'Finalizada')
                                @php
                                    $i+= 1;
                                @endphp
                            @endif
                        @endforeach
                        <div class="alert alert-success alert-dismissible fade show" role="alert">

                            La solicitud finalizó satisfactoriamente el <b>{{ $solicitud->fecha_finalizacion }}</b>
                            <br>
                            Se completaron <b>{{ $i }}/{{ $solicitud->tareas->count() }}</b> requerimientos 

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                <!-- Formulario Solicitudes -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardSolicitud" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="font-weight-bold text-primary">
                                    Datos de la Solicitud:
                                    <h6 class="m-0 font-weight-bold text-dark">
                                        {{ $solicitud->codigo_solicitud }}
                                    </h6>
                                </h6>
                            </a>
                        <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardSolicitud">
                                <div class="card-body">

                                    {{-- Cuerpo Formulario--}}
                                        {{-- Estados de la solicitud --}}
                                            @if ($solicitud->estado === 'Pendiente')
                                                <div class="form-row">
                                                    <h5><span class="badge badge-info ml-2">{{ $solicitud->estado }}</span>&nbsp;</h5>
                                                    <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                        title="Estado de la solicitud">?</a>
                                                </div>
                                            @endif
                                            @if ($solicitud->estado === 'Aprobado')
                                                <div class="form-row">
                                                    <h5><span class="badge badge-success ml-2">{{ $solicitud->estado }}</span></h5>
                                                    <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                    title="Estado de la solicitud">?</a>
                                                </div>
                                            @endif
                                            @if ($solicitud->estado === 'Finalizado')
                                                <div class="form-row">
                                                    <h5><span class="badge badge-success ml-2">{{ $solicitud->estado }}</span></h5>
                                                    <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                            title="Estado de la solicitud">?</a>
                                                </div>
                                            @endif
                                            @if ($solicitud->estado === 'Reprobado')
                                                <div class="form-row">
                                                    <h5><span class="badge badge-danger ml-2">{{ $solicitud->estado }}</span></h5>
                                                    <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                            title="Estado de la solicitud">?</a>
                                                </div>
                                            @endif
                                            <br>

                                        {{-- Codigo y Funcionario Contribuyente--}}
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail4"><strong>Codigo de la Solicitud:</strong></label>
                                                    <input id="codigo" type="text" class="form-control" disabled value=" {{ $solicitud->codigo_solicitud }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                                <div class="form-group col-md-3" style="margin-left: 425px">
                                                    <label for="inputEmail4"><strong>Funcionario Contribuyente:</strong></label>
                                                    <input id="codigo" type="text" class="form-control" disabled value="{{ $solicitud->users->name }}  {{ $solicitud->users->apellido_pater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                            </div>
                                            <hr>
                                            
                                        {{-- Fechas --}}
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress"><strong>Fecha de Emision:</strong></label>
                                                    <input id="codigo" type="text" class="form-control" disabled value=" {{ $solicitud->fecha_emision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                                {{-- Cambia el color de las Fechas segun el estado de la solicitud --}}
                                                    @if ($solicitud->fecha_revision)
                                                        @if ($solicitud->estado === 'Pendiente')
                                                            <div class="form-group col-md-6">
                                                                <label for="inputAddress"><strong>Fecha de Revision:</strong></label>
                                                                <input id="codigo" type="text" class="form-control bg-info text-light" disabled value=" {{ $solicitud->fecha_revision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        @endif
                                                        @if ($solicitud->estado === 'Finalizado')
                                                            <div class="form-group col-md-6">
                                                                <label for="inputAddress"><strong>Fecha de Revision:</strong></label>
                                                                <input id="codigo" type="text" class="form-control bg-success text-light" disabled value=" {{ $solicitud->fecha_revision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        @endif
                                                        @if ($solicitud->estado === 'Aprobado')
                                                            <div class="form-group col-md-6">
                                                                <label for="inputAddress"><strong>Fecha de Revision:</strong></label>
                                                                <input id="codigo" type="text" class="form-control bg-success text-light" disabled value=" {{ $solicitud->fecha_revision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        @endif
                                                        @if ($solicitud->estado === 'Reprobado')
                                                            <div class="form-group col-md-6">
                                                                <label for="inputAddress"><strong>Fecha de Revision:</strong></label>
                                                                <input id="codigo" type="text" class="form-control bg-danger text-light" disabled value=" {{ $solicitud->fecha_revision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="form-group col-md-6">
                                                            <label for="inputAddress"><strong>Fecha de Revision:</strong></label>
                                                            <input id="codigo" type="text" class="form-control" disabled value=" {{ $solicitud->fecha_revision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                        </div>
                                                    @endif
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress"><strong>Fecha de Inicio Estimada:</strong></label>
                                                    <input id="codigo" type="text" class="form-control" disabled value=" {{ $solicitud->fecha_inicio }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                                
                                                {{-- Cambia el color de la fecha fin en caso de estar cerca de la fecha final o en caso de haberla alcanzado --}}
                                                    @if ($solicitud->fecha_fin >= $date && $solicitud->fecha_fin > $solicitud->fecha_finalizacion
                                                        || $solicitud->fecha_fin >= $date && $solicitud->fecha_finalizacion === NULL)
                                                        <div class="form-group col-md-6">

                                                            <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                title="La fecha para concluir esta solicitud ya expiro o esta cerca de hacerlo">?</a>

                                                            <label for="inputAddress"><strong>Fecha de Fin Estimada:</strong></label>
                                                            <input id="codigo" type="text" class="form-control bg-warning" disabled value=" {{ $solicitud->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                        
                                                        </div>
                                                    @else
                                                        <div class="form-group col-md-6">

                                                            <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                title="Fecha en la que se espera concluir la solicitud">?</a>

                                                            <label for="inputAddress"><strong>Fecha de Fin Estimada:</strong></label>
                                                            <input id="codigo" type="text" class="form-control bg-info text-light" disabled value=" {{ $solicitud->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                        </div>
                                                    @endif
                                            </div>
                                            <hr>

                                        {{-- Observaciones y Detalles --}}
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity">Detalle:</label>
                                                    <textarea id="detalle" type="text" class="form-control" disabled placeholder=" {{ $solicitud->detalle }}" name="detalle" required autocomplete="detalle" autofocus></textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputState">Observacion:</label>
                                                    <textarea id="obsservacion" type="text" class="form-control" disabled placeholder=" {{ $solicitud->observacion }}" name="observacion"></textarea>
                                                </div>
                                            </div>
                                            <br>

                                        {{-- btn--}}
                                            @if($solicitud->estado != 'Reprobado' && $solicitud->estado != 'Finalizado')
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6" style="margin-left: 357px">
                                                        @can('solicitudes.edit')
                                                            <a href="{{ route('solicituds.pdf', Hashids::encode($solicitud->id)) }}" class="btn btn-sm btn-info">
                                                                <i class="fas fa-fw fa-file-alt"></i>
                                                                PDF
                                                            </a>
                                                        @endcan
                                                        @can('solicitudes.edit')
                                                            <a href="{{ route('solicituds.edit', Hashids::encode($solicitud->id)) }}" class="btn btn-sm btn-warning">
                                                                <i class="fas fa-fw fa-pen"></i>
                                                                Editar
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            @else
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-6" style="margin-left: 390px">
                                                        @can('solicitudes.edit')
                                                            <a href="{{ route('solicituds.pdf', Hashids::encode($solicitud->id)) }}" class="btn btn-sm btn-info">
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
            @can('clientes.show')
                <!-- Formulario Cliente -->
                    <!-- Divider -->
                        <div class="sidebar-heading text-center">
                            Solicitante
                        </div>
                        <hr class="sidebar-divider">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardCliente" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="font-weight-bold text-primary">
                                    Datos del Cliente Solicitante:
                                    <h6 class="m-0 font-weight-bold text-dark">
                                        {{ $solicitud->clientes->name }} {{ $solicitud->clientes->apellido_pater }} {{ $solicitud->clientes->apellido_mater }}
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
                                                <input id="codigo" type="text" class="form-control" disabled value="{{ $solicitud->clientes->cedula }}" name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Nombre--}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Nombre del solicitante</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" class="form-control" disabled value="{{ $solicitud->clientes->name }} {{ $solicitud->clientes->apellido_pater }} {{ $solicitud->clientes->apellido_mater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Direccion --}}
                                        <div class="form-group row">
                                            <label for="direc" class="col-md-4 col-form-label text-md-right">Direccion</label>

                                            <div class="col-md-6">
                                                <input id="direc" type="text" class="form-control" disabled value="{{ $solicitud->clientes->direc }}" name="direc" required autofocus>
                                            </div>
                                        </div>

                                    {{-- Telefono --}}
                                        <div class="form-group row">
                                            <label for="tlf" class="col-md-4 col-form-label text-md-right">Telefono</label>

                                            <div class="col-md-6">
                                                <input id="tlf" type="text" class="form-control" disabled value="{{ $solicitud->clientes->tlf }}" name="tlf" required autofocus>
                                            </div>
                                        </div>

                                    {{-- Email --}}
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" disabled value="{{ $solicitud->clientes->email }}" name="email" required autofocus>
                                            </div>
                                        </div>

                                    {{-- btn--}}
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-6">
                                                @can('clientes.show')
                                                    <a href="{{ route('clientes.show', Hashids::encode($solicitud->clientes->id)) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-fw fa-eye"></i>
                                                        Ver
                                                    </a>
                                                @endcan
                                                @can('clientes.edit')
                                                    <a href="{{ route('clientes.edit', Hashids::encode($solicitud->clientes->id)) }}" class="btn btn-sm btn-warning">
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
            @can('tareas.show')
                <!-- Formulario Tareas -->

                    <!-- Divider -->
                        <div class="sidebar-heading text-center">
                            Requerimientos
                        </div>
                        <hr class="sidebar-divider">

                    <div class="row">

                        @if(@$solicitud->tareas->first())
                            @foreach (@App\Solicitud::findOrFail($solicitud->id)->tareas as $item)

                                <div class="col-lg-6">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Accordion -->
                                                <a href="#collapseCardTareas{{ $loop->iteration}}" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                    <h6 class="font-weight-bold text-primary">
                                                        Datos del Requerimiento:
                                                        <h6 class="m-0 font-weight-bold text-dark">
                                                            <i>{{ $item->fake_id}}</i>
                                                        </h6>
                                                    </h6>
                                                </a>
                                        <!-- Card Content - Collapse -->
                                                <div class="collapse hide" id="collapseCardTareas{{ $loop->iteration}}">
                                                    <div class="card-body">

                                                        {{-- Codigo Tarea --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $item->fake_id }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Fecha Inicio --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Inicio</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $item->fecha_inicio }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Fecha Fin --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Fin</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $item->fecha_fin }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Direccion --}}
                                                            <div class="form-group row">
                                                                <label for="detalle" class="col-md-4 col-form-label text-md-right">Direccion</label>
                                                                <div class="col-md-6">
                                                                    <textarea type="text" disabled class="form-control" required autocomplete="direccion" autofocus> {{ $item->direc_tarea }} </textarea>
                                                                </div>
                                                            </div>

                                                        {{-- Detalle --}}
                                                            <div class="form-group row">
                                                                <label for="detalle" class="col-md-4 col-form-label text-md-right">Detalle</label>
                                                                <div class="col-md-6">
                                                                    <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->detalle }} </textarea>
                                                                </div>
                                                            </div>

                                                        {{-- Observacion --}}
                                                            <div class="form-group row">
                                                                <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                                <div class="col-md-6">
                                                                    <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->observacion }} </textarea>
                                                                </div>
                                                            </div>

                                                        {{-- Estado --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $item->estado }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Vehiculos asignados --}}
                                                            <div class="text-center">
                                                                @if (@$item->maquinarias)
                                                                    <a href="{{ route('asigna.edit', Hashids::encode($item->id)) }}">
                                                                        <em>Se ha asignado {{ $item->maquinarias->count() }} maquinaria(s) a este requerimiento</em><br><br>
                                                                    </a>
                                                                @else
                                                                    <em>No se han asignado maquinarias a esta tarea</em><br><br>
                                                                @endif
                                                            </div>

                                                        {{-- btn--}}
                                                            <div class="form-group row mb-0">
                                                                @if($item->estado != 'Finalizada' && $item->estado != 'Abandonado')
                                                                    <div class="col-md-6 offset-md-4">
                                                                        @can('tareas.show')
                                                                            <a href="{{ route('tareas.show', Hashids::encode($item->id)) }}" class="btn btn-sm btn-info">
                                                                                <i class="fas fa-fw fa-eye"></i>
                                                                                Ver
                                                                            </a>
                                                                        @endcan
                                                                        @can('tareas.edit')
                                                                            <a href="{{ route('tareas.edit', Hashids::encode($item->id)) }}" class="btn btn-sm btn-warning">
                                                                                <i class="fas fa-fw fa-pen"></i>
                                                                                Editar
                                                                            </a>
                                                                        @endcan
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-6 offset-md-5">
                                                                        @can('tareas.show')
                                                                            <a href="{{ route('tareas.show', Hashids::encode($item->id)) }}" class="btn btn-sm btn-info">
                                                                                <i class="fas fa-fw fa-eye"></i>
                                                                                Ver
                                                                            </a>
                                                                        @endcan
                                                                    </div>
                                                                @endif
                                                            </div>

                                                    </div>
                                                </div>
                                    </div>
                                </div>

                            @endforeach
                        @endif
                        
                        <!-- Boton Agregar Nueva Tarea -->
                            @if($solicitud->estado != 'Reprobado' && $solicitud->estado != 'Finalizado')
                                <div class="col-lg-6">
                                    <div class="row justify-content-center">
                                        @can('tareas.create')
                                            <a href="{{ route('tareas.createfrom', Hashids::encode($solicitud->id)) }}">
                                                <img class="img-responsive img-rounded float-left" src="{{ asset('images/plus.png') }}" title="Agregar Requerimiento">
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
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@stop