@extends('layouts.app')

@section('content')

<form id="formSolicitud" method="POST" action="{{ route('solicituds.store') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10">
            @can('solicitudes.show')
                {{-- Variables y demás php Global --}}
                    @php
                        $i = 0;
                        $date = date("Y-m-d");
                        $mantenimientos = 0;
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
                                                            @can('agregar.fechas')
                                                                @if (!$solicitud->fecha_inicio)

                                                                    {{-- Boton calendario --}}
                                                                        <a href="{{ route('solicituds.agregafechas', Hashids::encode($solicitud->id)) }}" class="btn btn-sm btn-success"
                                                                            data-toggle="tooltip" data-placement="left" title="Haga clic para agregar una fecha de inicio y de fin a esta solicitud">
                                                                            <i class="fas fa-fw fa-calendar-alt"></i>
                                                                        </a>

                                                                @endif
                                                            @endcan
                                                            @can('solicitudes.edit')
                                                                <a href="{{ route('solicituds.pdf', Hashids::encode($solicitud->id)) }}" class="btn btn-sm btn-info" target="_blank">
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
                                                                <a href="{{ route('solicituds.pdf', Hashids::encode($solicitud->id)) }}" class="btn btn-sm btn-info" target="_blank">
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
                                                        title="Ver los datos del cliente" target="_blank">

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
                                                    @if ($solicitud->fecha_fin)
                                                        @if ($solicitud->fecha_fin <= $date && $solicitud->fecha_fin > $solicitud->fecha_finalizacion
                                                        || $solicitud->fecha_fin <= $date && $solicitud->fecha_finalizacion === NULL)
                                                            <div class="form-group col-md-6">

                                                                <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                    title="La fecha para concluir esta solicitud ya expiro o esta cerca de hacerlo">?</a>

                                                                <label for="inputAddress"><strong>Fecha de Fin Estimada:</strong></label>
                                                                <input id="codigo" type="text" class="form-control bg-warning" disabled value=" {{ $solicitud->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                            
                                                            </div>
                                                        @endif
                                                        @if($solicitud->fecha_fin >= $date && $solicitud->estado != 'Finalizado' 
                                                            && $solicitud->estado != 'Reprobado')
                                                            <div class="form-group col-md-6">

                                                                <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                    title="Fecha en la que se espera concluir la solicitud. Quedan {{ $days }} dias
                                                                    hasta cumplir con la fecha">?</a>

                                                                <label for="inputAddress"><strong>Fecha de Fin Estimada:</strong></label>
                                                                <input id="codigo" type="text" class="form-control bg-info text-light" disabled value="{{ $solicitud->fecha_fin }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        @endif
                                                        @if($solicitud->estado == 'Finalizado' || $solicitud->estado == 'Reprobado')
                                                            <div class="form-group col-md-6">

                                                                <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                    title="Fecha en la que se espera concluir la solicitud.">?</a>

                                                                <label for="inputAddress"><strong>Fecha de Fin Estimada:</strong></label>
                                                                <input id="codigo" type="text" class="form-control" disabled value="{{ $solicitud->fecha_fin }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="form-group col-md-6">

                                                            <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                title="Fecha en la que se espera concluir la solicitud. Aun no se ha agregado una fecha">?</a>

                                                            <label for="inputAddress"><strong>Fecha de Fin Estimada:</strong></label>
                                                            <input id="codigo" type="text" class="form-control" disabled value=" {{ $solicitud->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
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

                                                            {{-- Condicion de Notificaciones --}}
                                                                @php
                                                                    $notificaciones = 0;
                                                                @endphp
                                                                {{-- Si el requerimiento termina despues que la solicitud o si alcanzo a la fecha final de la solicitud --}}
                                                                @if ($item->fecha_fin >= $solicitud->fecha_fin && $item->estado !== 'Finalizada' && $item->estado !== 'Abandonado')
                                                                    @php
                                                                        $notificaciones += 1;
                                                                    @endphp
                                                                @endif
                                                                {{-- Si el requerimiento ha alcanzado o sobrepasado la fecha actual sin finalizar --}}
                                                                @if ($item->fecha_fin <= $date && $item->fecha_fin !== NULL && $item->estado !== 'Finalizada' && $item->estado !== 'Abandonado')
                                                                    @php
                                                                        $notificaciones += 1;
                                                                    @endphp
                                                                @endif
                                                                {{-- Si el requerimiento tiene una fecha de inicio anterior al inicio de la solicitud --}}
                                                                @if ($item->fecha_inicio < $solicitud->fecha_inicio && $item->fecha_fin !== NULL && $item->estado !== 'Finalizada' && $item->estado !== 'Abandonado')
                                                                    @php
                                                                        $notificaciones += 1;
                                                                    @endphp
                                                                @endif
                                                                {{-- Si el requerimiento tiene un asignado un vehiculo que entro en mantenimiento recientemente --}}
                                                                @if(@$item->maquinarias->first())
                                                                    @foreach (@App\Tarea::findOrFail($item->id)->maquinarias as $item2)
                                                                    
                                                                        @if (count($item2->mantenimientos->where('estado', 'Activo')) >= 1 
                                                                        || count($item2->mantenimientos->where('estado', 'En espera')) >= 1 
                                                                        || count($item2->mantenimientos->where('estado', 'Inactivo')) >= 1)
                                                                            @php
                                                                                $mantenimientos += 1;
                                                                                $notificaciones +=1;
                                                                            @endphp
                                                                        @endif

                                                                    @endforeach
                                                                @endif

                                                            {{-- Mostrar notificaciones totales --}}
                                                                @if ($item->estado !== 'Finalizada' && $item->estado !== 'Abandonado')

                                                                    @if ($notificaciones >= 1)
                                                                        <span class="badge float-right badge-danger ml-2" data-toggle="tooltip"
                                                                        data-placement="top" title="Importante!">{{$notificaciones}}</span>
                                                                    @endif

                                                                @endif
                                                            
                                                            {{-- ID del requerimiento en el header --}}
                                                                <h6 class="m-0 font-weight-bold text-dark">
                                                                    <i>{{ $item->fake_id}}</i>
                                                                </h6>
                                                        </h6>
                                                    </a>

                                                <!-- Card Content - Collapse -->
                                                    <div class="collapse hide" id="collapseCard{{ $loop->iteration }}">
                                                        <div class="card-body">

                                                            {{--Notificacion en el requerimiento en caso de que un vehiculo asignado posea requerimiento activo--}}

                                                                @if (@$mantenimientos >= 1 && $item->estado !== 'Finalizada' && $item->estado !== 'Abandonado')
                                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                        <strong>Tenemos un problema!.</strong> Este requerimiento posee un vehiculo que ha entrado 
                                                                        en mantenimiento recientemente, por lo que es posible que no se encuentre disponible hasta 
                                                                        culminar con el proceso. Consulte las <strong><a data-toggle="modal" data-id="{{ $item->id }}" 
                                                                            data-target="#MaquinariaModal{{ $loop->iteration }}" value="{{ $item->id }}">Maquinarias Asignadas</a></strong> para obtener 
                                                                        mas informacion.
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                @endif

                                                            {{-- Estados, Codigo y Botones del requerimiento --}}
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
                                                                            @if($solicitud->estado != 'Finalizado' && $solicitud->estado != 'Reprobado')
                                                                                @if($item->estado != 'Finalizada' && $item->estado != 'Abandonado')
                                                                                    <div class="col-md-12">
                                                                                        @can('agregar.fechas')
                                                                                            @if (!$item->fecha_inicio)

                                                                                                {{-- Boton calendario --}}
                                                                                                    <a href="{{ route('tareas.agregafechas', Hashids::encode($item->id)) }}" class="btn btn-sm btn-success"
                                                                                                        data-toggle="tooltip" data-placement="left" title="Haga clic para agregar una fecha de inicio y de fin a este requerimiento">
                                                                                                        <i class="fas fa-fw fa-calendar-alt"></i>
                                                                                                    </a>

                                                                                            @endif
                                                                                        @endcan
                                                                                        @can('tareas.show')
                                                                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-id="{{ $item->id }}" 
                                                                                                data-target="#MaquinariaModal{{ $loop->iteration }}" value="{{ $item->id }}">
                                                                                                <i class="fas fa-fw fa-eye"></i>
                                                                                                Maquinarias Asignadas
                                                                                            </button>
                                                                                        @endcan
                                                                                        @can('tareas.edit')
                                                                                            <a href="{{ route('tareas.edit', Hashids::encode($item->id)) }}" class="btn btn-sm btn-warning">
                                                                                                <i class="fas fa-fw fa-pen"></i>
                                                                                                Editar
                                                                                            </a>
                                                                                        @endcan
                                                                                    </div>
                                                                                @endif
                                                                            @else
                                                                                <div class="col-md-12">
                                                                                    @can('tareas.show')
                                                                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-id="{{ $item->id }}" 
                                                                                            data-target="#MaquinariaModal{{ $loop->iteration }}" value="{{ $item->id }}">
                                                                                            <i class="fas fa-fw fa-eye"></i>
                                                                                            Maquinarias Asignadas
                                                                                        </button>
                                                                                        {{--
                                                                                        <a href="{{ route('tareas.show', Hashids::encode($item->id)) }}" class="btn btn-sm btn-info">
                                                                                            <i class="fas fa-fw fa-eye"></i>
                                                                                            Ver
                                                                                        </a>--}}
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

                                                                    {{-- Cambia el color de las Fechas segun la fecha de inicio del Requerimiento --}}
                                                                        @if ($item->estado === 'Abandonado' || $item->fecha_inicio === NULL)

                                                                            <div class="form-group col-md-6">
                                                                                <label for="inputAddress"><strong>Fecha de Inicio:</strong></label>
                                                                                <input id="codigo" type="text" class="form-control" disabled value=" {{ $item->fecha_inicio }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                            </div>
                                                                        
                                                                        @else

                                                                            @if ($item->fecha_inicio < $solicitud->fecha_inicio)
                                                                
                                                                                <div class="form-group col-md-6">
                                                                                    <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                                    title="La fecha de inicio de este requerimiento es anterior al inicio de la propia solicitud">?</a>

                                                                                    <label for="inputAddress"><strong>Fecha de Inicio:</strong></label>
                                                                                    <input id="codigo" type="text" class="form-control bg-danger text-light" disabled value=" {{ $item->fecha_inicio }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                                </div>

                                                                            @else

                                                                                <div class="form-group col-md-6">
                                                                                    <label for="inputAddress"><strong>Fecha de Inicio:</strong></label>
                                                                                    <input id="codigo" type="text" class="form-control" disabled value=" {{ $item->fecha_inicio }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                                </div>

                                                                            @endif

                                                                        @endif

                                                                    {{-- Cambia el color de las Fechas segun la fecha de fin del Requerimiento --}}
                                                                        
                                                                        {{-- Si el requerimiento alcanza la fecha final de la solicitud y al mismo tiempo alcanza
                                                                             la fecha actual. se cumple la condicion --}}
                                                                        @if ($item->fecha_fin >= $solicitud->fecha_fin && $item->fecha_fin <= $date
                                                                            && $item->estado !== 'Finalizada' && $item->estado !== 'Abandonado')
                                                                            
                                                                            <div class="form-group col-md-6">
                                                                                <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                                title="1. La fecha para concluir este requerimiento ya expiro o esta cerca de hacerlo.-------
                                                                                        2. La fecha para concluir este requerimiento se esta aproximando o ha sobre pasado a la fecha final de la solicitud">?</a>

                                                                                <label for="inputAddress"><strong>Fecha de Fin:</strong></label>
                                                                                <input id="codigo" type="text" class="form-control bg-danger text-light" disabled value=" {{ $item->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                            </div>

                                                                        @else

                                                                            {{-- Si el requerimiento esta abandonado o finalizado --}}
                                                                            @if ($item->estado === 'Abandonado' || $item->estado === 'Finalizada' || $item->fecha_fin === NULL)

                                                                                <div class="form-group col-md-6">
                                                                                    <label for="inputAddress"><strong>Fecha de Fin:</strong></label>
                                                                                    <input id="codigo" type="text" class="form-control" disabled value=" {{ $item->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                                </div>

                                                                            @endif

                                                                            {{-- Si el requerimiento esta entre las fechas validas --}}
                                                                            @if ($item->fecha_fin > $date && $item->fecha_fin < $solicitud->fecha_fin 
                                                                            && $item->estado !== 'Finalizada' && $item->estado !== 'Abandonado')
                                                                                
                                                                                @if ($item->fecha_fin > $date)
                                                                                    <div class="form-group col-md-6">
                                                                                        <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                                            title="Fecha en la que se espera concluir el requerimiento">?</a>

                                                                                        <label for="inputAddress"><strong>Fecha de Fin:</strong></label>
                                                                                        <input id="codigo" type="text" class="form-control bg-info text-light" disabled value=" {{ $item->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                                    </div>
                                                                                @endif

                                                                            @endif

                                                                            {{-- Si el requerimiento termina despues que la solicitud o si alcanzo a la fecha final de la solicitud --}}
                                                                            @if ($item->fecha_fin >= $solicitud->fecha_fin && $item->estado !== 'Finalizada' && $item->estado !== 'Abandonado')
                                                                                
                                                                                <div class="form-group col-md-6">
                                                                                    <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                                    title="La fecha para concluir este requerimiento se esta aproximando o ha sobre pasado a la fecha final de la solicitud">?</a>

                                                                                    <label for="inputAddress"><strong>Fecha de Fin:</strong></label>
                                                                                    <input id="codigo" type="text" class="form-control bg-danger text-light" disabled value=" {{ $item->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                                                </div>

                                                                            @endif

                                                                            {{-- Si el requerimiento ha alcanzado o sobrepasado la fecha actual sin finalizar --}}
                                                                            @if ($item->fecha_fin <= $date && $item->fecha_fin !== NULL && $item->estado !== 'Finalizada' && $item->estado !== 'Abandonado')
                                                                                
                                                                                <div class="form-group col-md-6">
                                                                                    <a href="#" class="boton text-light" data-toggle="tooltip" data-placement="top"
                                                                                    title="La fecha para concluir este requerimiento ya expiro o esta cerca de hacerlo">?</a>

                                                                                    <label for="inputAddress"><strong>Fecha de Fin:</strong></label>
                                                                                    <input id="codigo" type="text" class="form-control bg-danger text-light" disabled value=" {{ $item->fecha_fin }} " name="codigo" required autocomplete="Codigo" autofocus>
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

                                                            {{-- Modal Divisar maquinarias asignadas --}}
                                                                <div class="modal fade" id="MaquinariaModal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="font-weight-bold text-danger">
                                                                                    Maquinarias asignadas al requerimiento: &nbsp;
                                                                                    <h5 class="m-0 font-weight-bold text-dark">
                                                                                        <i> {{ $item->fake_id }}</i>
                                                                                    </h5>
                                                                                </h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                @if(@$item->maquinarias->first())
                                                                                    @foreach (@App\Tarea::findOrFail($item->id)->maquinarias as $item2)
                                                                                    
                                                                                        <div class="col-lg-12">
                                                                                            <div class="card shadow mb-4">
                                                                                                <!-- Card Header - Accordion -->
                                                                                                    @if (count($item2->mantenimientos->where('estado', 'Activo')) >= 1 
                                                                                                    || count($item2->mantenimientos->where('estado', 'En espera')) >= 1 
                                                                                                    || count($item2->mantenimientos->where('estado', 'Inactivo')) >= 1)

                                                                                                        <a href="#collapseCardTareas{{ $loop->iteration}}" class="d-block card-header py-3 border-left-danger border-danger" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                                                                            <h6 class="font-weight-bold text-danger">
                                                                                                                Datos de la Maquinaria:
                                                                                                                <span class="badge badge-secondary float-right">Importante</span>
                                                                                                                <h6 class="m-0 font-weight-bold text-dark">
                                                                                                                    <i>{{ $item2->codigo_nro_gad}} - {{ $item2->tipo_vehiculo }}</i>
                                                                                                                </h6>
                                                                                                            </h6>
                                                                                                        </a>

                                                                                                    @else
                                                                                                        <a href="#collapseCardTareas{{ $loop->iteration}}" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                                                                            <h6 class="font-weight-bold text-primary">
                                                                                                                Datos de la Maquinaria:
                                                                                                                <h6 class="m-0 font-weight-bold text-dark">
                                                                                                                    <i>{{ $item2->codigo_nro_gad}} - {{ $item2->tipo_vehiculo }}</i>
                                                                                                                </h6>
                                                                                                            </h6>
                                                                                                        </a>
                                                                                                    @endif
                                                                                                        
                                                                                                <!-- Card Content - Collapse -->
                                                                                                    <div class="collapse hide" id="collapseCardTareas{{ $loop->iteration}}">
                                                                                                        <div class="card-body">

                                                                                                            {{-- Alert en caso de estar en mantenimiento --}}
                                                                                                                @if (count($item2->mantenimientos->where('estado', 'Activo')) >= 1 
                                                                                                                || count($item2->mantenimientos->where('estado', 'En espera')) >= 1 
                                                                                                                || count($item2->mantenimientos->where('estado', 'Inactivo')) >= 1)

                                                                                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                                                                        <strong>Tenemos un problema!.</strong> Este vehiculo ha entrado en mantenimiento recientemente,
                                                                                                                        por lo que es posible que no se encuentre disponible hasta culminar con el proceso.
                                                                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                                        </button>
                                                                                                                    </div>
                                                                                                                @endif

                                                                                                            {{-- Codigo GAD --}}
                                                                                                                <div class="form-group row">
                                                                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo GAD</label>
                                                                                                                    <div class="col-md-6">
                                                                                                                        <input type="input" disabled value="{{ $item2->codigo_nro_gad }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            {{-- Placa --}}
                                                                                                                <div class="form-group row">
                                                                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Placa</label>
                                                                                                                    <div class="col-md-6">
                                                                                                                        <input type="input" disabled value="{{ $item2->placa }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            {{-- Marca --}}
                                                                                                                <div class="form-group row">
                                                                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Marca</label>
                                                                                                                    <div class="col-md-6">
                                                                                                                        <input type="input" disabled value="{{ $item2->marcas->marca }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            {{-- Modelo --}}
                                                                                                                <div class="form-group row">
                                                                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Modelo</label>
                                                                                                                    <div class="col-md-6">
                                                                                                                        <input type="input" disabled value="{{ $item2->anio }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            {{-- Año --}}
                                                                                                                <div class="form-group row">
                                                                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Año</label>
                                                                                                                    <div class="col-md-6">
                                                                                                                        <input type="input" disabled value="{{ $item2->anio }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            {{-- Tipo --}}
                                                                                                                <div class="form-group row">
                                                                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Tipo</label>
                                                                                                                    <div class="col-md-6">
                                                                                                                        <input type="input" disabled value="{{ $item2->tipo_vehiculo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            {{-- Observacion --}}
                                                                                                                <div class="form-group row">
                                                                                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                                                                                    <div class="col-md-6">
                                                                                                                        <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item2->observacion }} </textarea>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            {{-- Operario --}}
                                                                                                                <div class="form-group row">
                                                                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Operador</label>
                                                                                                                    <div class="col-md-6">
                                                                                                                        @if (@$item2->operarios)
                                                                                                                            <input type="input" disabled value="{{ $item2->operarios->name }} {{ $item2->operarios->apellido_pater }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                                                                        @else
                                                                                                                            <input type="input" disabled value="N/A" class="form-control bg-danger text-light" required autocomplete="Fecha fin" autofocus>
                                                                                                                        @endif
                                                                                                                        
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            {{-- btn--}}
                                                                                                                <div class="form-group row mb-0">
                                                                                                                    <div class="align-items-center col-md-6 offset-md-5">
                                                                                                                        @can('maquinarias.show')
                                                                                                                            <a href="{{ route('maquinarias.show', Hashids::encode($item2->id)) }}" class="btn btn-sm btn-info">
                                                                                                                                <i class="fas fa-fw fa-eye"></i>
                                                                                                                                Ver
                                                                                                                            </a>
                                                                                                                        @endcan
                                                                                                                        @can('maquinarias.edit')
                                                                                                                            <a href="{{ route('maquinarias.edit', Hashids::encode($item2->id)) }}" class="btn btn-sm btn-warning">
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
                                                                                @else
                                                                                    <br><br>
                                                                                    <strong class="mt-5 mb-5 text-center"><h5><em>No se han asignado maquinarias para ejecutar este requerimiento</em></h5></strong>
                                                                                    <br><br>
                                                                                @endif

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                                                @can('actividades.encargos.asignaciones')

                                                                                    @if ($item->estado !== 'Abandonado' && $item->estado !== 'Finalizada')
                                                                                        <div class="text-center">
                                                                                            <a href="{{ route('asigna.edit', Hashids::encode($item->id)) }}" class="btn btn-sm btn-success">
                                                                                                <i class="fas fa-plus"></i>
                                                                                                Asignar Maquinarias
                                                                                            </a>
                                                                                        </div>
                                                                                    @endif

                                                                                @endcan
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

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

    // Enviar detalle y observacion al modal de revision
        $('#MaquinariaModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-body ').val(id)
        })
</script>
@stop