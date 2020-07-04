@extends('layouts.app')

@section('content')

<form id="formSolicitud" method="POST" action="{{ route('solicituds.store') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10">
            @can('solicitudes.show')
                @php
                    $i = 0;
                    $date = date("Y-m-d");
                    //resta los dias actuales menos los dias de la fecha final para obtener los dias restantes
                    $diff = abs(strtotime($date) - strtotime($solicitud->fecha_fin));
                    //convertir a años
                    $years = floor($diff / (365*60*60*24));
                    //convertir a meses
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    //convertir a dias
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                @endphp

                <!-- Alert en caso de estar finalizada la solicitud -->
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

                                        {{-- Estados de la solicitud y Botones--}}
                                            <div class="form-row">
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
                                            
                                                {{-- btns--}}
                                                @if($solicitud->estado != 'Reprobado' && $solicitud->estado != 'Finalizado')
                                                    <div class="form-group row mb-0" style="margin-left: auto;">
                                                        <div class="col-md-12">
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
                                                    <div class="form-group row mb-0" style="margin-left: auto;">
                                                        <div class="col-md-12">
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
                                        <br>

                                        {{-- Codigo, Funcionario Contribuyente y Solicitante--}}
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail4"><strong>Codigo de la Solicitud:</strong></label>
                                                    <input id="codigo" type="text" class="form-control" disabled value=" {{ $solicitud->codigo_solicitud }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                                <div class="form-group col-md-3" style="margin-left: auto;">
                                                    <label for="inputEmail4"><strong>Funcionario Contribuyente:</strong></label>
                                                    <input id="codigo" type="text" class="form-control" disabled value="{{ $solicitud->users->name }}  {{ $solicitud->users->apellido_pater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                                <div class="form-group col-md-3 ml-2" style="margin-left: auto;">
                                                    <div class="form-row">
                                                        <label for="inputEmail4"><strong>Solicitante:</strong></label>
                                                        <input id="codigo" type="text" class="form-control" disabled value="{{ $solicitud->clientes->name }} {{ $solicitud->clientes->apellido_pater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                        <a href="{{ route('clientes.show', Hashids::encode($solicitud->clientes->id)) }}" 
                                                            class="boton text-dark" style="margin-top: 40px; background-color: #24bcf8;" 
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Ver los datos del cliente">

                                                            <i class="fas fa-fw fa-eye"></i>
                                                        </a>
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
                                                    @if ($solicitud->fecha_fin <= $date && $solicitud->fecha_fin > $solicitud->fecha_finalizacion
                                                        || $solicitud->fecha_fin <= $date && $solicitud->fecha_finalizacion === NULL)
                                                        <div class="form-group col-md-6">

                                                            <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                title="La fecha para concluir esta solicitud ya expiro o esta cerca de hacerlo">?</a>

                                                            <label for="inputAddress"><strong>Fecha de Fin Estimada:</strong></label>
                                                            <input id="codigo" type="text" class="form-control bg-warning" disabled value=" {{ $solicitud->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                        
                                                        </div>
                                                    @else
                                                        <div class="form-group col-md-6">

                                                            <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                title="Fecha en la que se espera concluir la solicitud. Quedan {{ $days }} dias
                                                                hasta cumplir con la fecha">?</a>

                                                            <label for="inputAddress"><strong>Fecha de Fin Estimada:</strong></label>
                                                            <input id="codigo" type="text" class="form-control bg-info text-light" disabled value=" {{ $solicitud->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                        </div>
                                                    @endif
                                            </div>
                                            <hr>

                                        {{-- Observaciones y Detalles --}}
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity"><strong>Detalle:</strong></label>
                                                    <textarea id="detalle" type="text" class="form-control" disabled placeholder=" {{ $solicitud->detalle }}" name="detalle" required autocomplete="detalle" autofocus></textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputState"><strong>Observacion:</strong></label>
                                                    <textarea id="obsservacion" type="text" class="form-control" disabled placeholder=" {{ $solicitud->observacion }}" name="observacion"></textarea>
                                                </div>
                                            </div>
                                            <br>

                                </div>
                            </div>
                    </div>
            @endcan
            @can('clientes.show')
                {{-- Formulario Cliente -->
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

                                    {{-- Cedula 
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Cedula del solicitante</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" class="form-control" disabled value="{{ $solicitud->clientes->cedula }}" name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Nombre
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Nombre del solicitante</label>
                                            <div class="col-md-6">
                                                <input id="codigo" type="text" class="form-control" disabled value="{{ $solicitud->clientes->name }} {{ $solicitud->clientes->apellido_pater }} {{ $solicitud->clientes->apellido_mater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                            </div>
                                        </div>

                                    {{-- Direccion 
                                        <div class="form-group row">
                                            <label for="direc" class="col-md-4 col-form-label text-md-right">Direccion</label>

                                            <div class="col-md-6">
                                                <input id="direc" type="text" class="form-control" disabled value="{{ $solicitud->clientes->direc }}" name="direc" required autofocus>
                                            </div>
                                        </div>

                                    {{-- Telefono 
                                        <div class="form-group row">
                                            <label for="tlf" class="col-md-4 col-form-label text-md-right">Telefono</label>

                                            <div class="col-md-6">
                                                <input id="tlf" type="text" class="form-control" disabled value="{{ $solicitud->clientes->tlf }}" name="tlf" required autofocus>
                                            </div>
                                        </div>

                                    {{-- Email 
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" disabled value="{{ $solicitud->clientes->email }}" name="email" required autofocus>
                                            </div>
                                        </div>

                                    {{-- btn
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
                    </div> --}}
            @endcan
            @can('tareas.show')
                <!-- Formulario Tareas -->

                    <!-- Divider -->
                        <div class="sidebar-heading text-center">
                            Requerimientos
                        </div>
                        <hr class="sidebar-divider">

                    {{-- Lista Requerimientos --}}
                        <div class="row mt-3 mb-3 ml-2 mr-2">

                            {{-- Requerimientos --}}
                                <div class="card col-md-12">

                                    {{-- Boton Agregar Requerimiento --}}
                                        @if ($solicitud->estado != 'Finalizado' && $solicitud->estado != 'Reprobado')
                                            @can('tareas.create')
                                                <div class="text-right mb-2 mt-3">
                                                    <a href="{{ route('tareas.createfrom', Hashids::encode($solicitud->id)) }}" class="btn btn-sm btn-success">
                                                        <i class="fas fa-plus"></i>
                                                        Agregar Requerimiento
                                                    </a>
                                                </div>
                                            @endcan
                                        @endif

                                    {{-- Tarjetas de Requerimientos --}}
                                        @foreach (App\Solicitud::findOrFail($solicitud->id)->tareas as $item)
                                        
                                            <div class="card mb-2 mt-2 shadow-lg">

                                                {{-- Header boton para expandir requerimientos --}}
                                                    <a href="#collapseCard{{ $loop->iteration }}" class="d-block card-header py-2 border-left-info" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                        <h6 class="font-weight-bold text-primary">
                                                            Datos del Requerimiento:
                                                            @if ($item->estado === 'Pendiente')
                                                                <span class="badge float-right badge-info ml-2">{{ $item->estado }}</span>
                                                            @endif
                                                            @if ($item->estado === 'Abandonado')
                                                                <span class="badge float-right badge-warning ml-2">{{ $item->estado }}</span>
                                                            @endif
                                                            @if ($item->estado === 'Finalizada')
                                                                <span class="badge float-right badge-success ml-2">{{ $item->estado }}</span>
                                                            @endif
                                                            @if ($item->estado === 'En Proceso')
                                                                <span class="badge float-right badge-success ml-2">{{ $item->estado }}</span>
                                                            @endif
                                                            @if ($item->fecha_fin <= $date && $item->fecha_fin > $solicitud->fecha_finalizacion
                                                                || $item->fecha_fin <= $date && $solicitud->fecha_finalizacion === NULL)
                                                                @if ($item->estado !== 'Abandonado')
                                                                    <span class="badge float-right badge-danger ml-2">1</span>
                                                                @endif
                                                            @endif
                                                            <h6 class="m-0 font-weight-bold text-dark">
                                                                <i>{{ $item->fake_id}}</i>
                                                            </h6>
                                                        </h6>
                                                    </a>

                                                <!-- Card Content - Collapse -->
                                                    <div class="collapse hide" id="collapseCard{{ $loop->iteration }}">
                                                        <div class="card-body">

                                                            {{-- Estados y Codigo del requerimiento --}}
                                                                <div class="form-row">

                                                                    {{-- Estados del requerimiento --}}
                                                                        @if ($item->estado === 'Pendiente')
                                                                            <div class="form-row">
                                                                                <h5><span class="badge badge-info ml-2">{{ $item->estado }}</span>&nbsp;</h5>
                                                                                <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                                                    title="Estado del requerimiento">?</a>
                                                                            </div>
                                                                        @endif
                                                                        @if ($item->estado === 'Abandonado')
                                                                            <div class="form-row">
                                                                                <h5><span class="badge badge-warning ml-2">{{ $item->estado }}</span></h5>
                                                                                <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                                                title="Estado del requerimiento">?</a>
                                                                            </div>
                                                                        @endif
                                                                        @if ($item->estado === 'Finalizada')
                                                                            <div class="form-row">
                                                                                <h5><span class="badge badge-success ml-2">{{ $item->estado }}</span></h5>
                                                                                <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                                                        title="Estado del requerimiento">?</a>
                                                                            </div>
                                                                        @endif
                                                                        @if ($item->estado === 'En Proceso')
                                                                            <div class="form-row">
                                                                                <h5><span class="badge badge-success ml-2">{{ $item->estado }}</span></h5>
                                                                                <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="right"
                                                                                        title="Estado del requerimiento">?</a>
                                                                            </div>
                                                                        @endif
                                                                        <br>
                                                                        
                                                                    {{-- btn--}}
                                                                        <div class="form-group row mb-0" style="margin-left: auto;">
                                                                            @if($item->estado != 'Finalizada' && $item->estado != 'Abandonado')
                                                                                <div class="col-md-12">
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
                                                                                <div class="col-md-12">
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

                                                                {{-- Codigo del requerimiento --}}
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-2">
                                                                            <label for="inputEmail4"><strong>Requerimiento:</strong></label>
                                                                            <input id="codigo" type="text" class="form-control" disabled value=" {{ $item->fake_id }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                        </div>
                                                                    </div>
                                                                    

                                                            <hr>

                                                            {{-- Fechas --}}
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputAddress"><strong>Fecha de Inicio:</strong></label>
                                                                        <input id="codigo" type="text" class="form-control" disabled value=" {{ $item->fecha_inicio }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                    </div>

                                                                    {{-- Cambia el color de las Fechas segun la fecha de fin del Requerimiento --}}
                                                                        @if ($item->estado === 'Abandonado')

                                                                            <div class="form-group col-md-6">
                                                                                <label for="inputAddress"><strong>Fecha de Fin:</strong></label>
                                                                                <input id="codigo" type="text" class="form-control" disabled value=" {{ $item->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                            </div>

                                                                        @else

                                                                            @if ($item->fecha_fin <= $date && $item->fecha_fin > $solicitud->fecha_finalizacion
                                                                            || $item->fecha_fin <= $date && $solicitud->fecha_finalizacion === NULL)
                                                                
                                                                                <div class="form-group col-md-6">
                                                                                    <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                                    title="La fecha para concluir este requerimiento ya expiro o esta cerca de hacerlo">?</a>

                                                                                    <label for="inputAddress"><strong>Fecha de Fin:</strong></label>
                                                                                    <input id="codigo" type="text" class="form-control bg-danger text-light" disabled value=" {{ $item->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                                </div>

                                                                            @else

                                                                                <div class="form-group col-md-6">
                                                                                    <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                                        title="Fecha en la que se espera concluir el requerimiento">?</a>

                                                                                    <label for="inputAddress"><strong>Fecha de Fin:</strong></label>
                                                                                    <input id="codigo" type="text" class="form-control bg-info text-light" disabled value=" {{ $item->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                                </div>

                                                                            @endif

                                                                        @endif
                                                                </div>
                                                            <hr>

                                                            {{-- Observaciones y Detalles --}}
                                                                <div class="form-row">
                                                                    
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputCity"><strong>Detalle:</strong></label>
                                                                        <textarea id="detalle" type="text" class="form-control" disabled placeholder=" {{ $item->detalle }}" name="detalle" required autocomplete="detalle" autofocus></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState"><strong>Direccion:</strong></label>
                                                                        <textarea id="obsservacion" type="text" class="form-control" disabled placeholder=" {{ $item->direc_tarea }}" name="observacion"></textarea>
                                                                    </div>

                                                                </div>
                                                                

                                                            {{-- Vehiculos asignados --}}
                                                                @can('actividades.encargos.asignaciones')

                                                                    @if ($item->estado !== 'Abandonado' && $item->estado !== 'Finalizada')
                                                                        <div class="text-center">
                                                                            @if (@$item->maquinarias)
                                                                                <a href="{{ route('asigna.edit', Hashids::encode($item->id)) }}">
                                                                                    <em>Se ha asignado {{ $item->maquinarias->count() }} maquinaria(s) a este requerimiento</em><br><br>
                                                                                </a>
                                                                            @else
                                                                                <em>No se han asignado maquinarias a esta tarea</em><br><br>
                                                                            @endif
                                                                        </div>
                                                                    @else
                                                                        <div class="text-center">
                                                                            @if (@$item->maquinarias)
                                                                                <em>Se ha asignado {{ $item->maquinarias->count() }} maquinaria(s) a este requerimiento</em><br><br>
                                                                            @else
                                                                                <em>No se han asignado maquinarias a esta tarea</em><br><br>
                                                                            @endif
                                                                        </div>
                                                                    @endif

                                                                @endcan

                                                        </div>
                                                    </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                </div>

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