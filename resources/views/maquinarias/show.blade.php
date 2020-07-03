@extends('layouts.app')

@section('content')

<form id="formSolicitud" method="POST" action="{{ route('solicituds.store') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('maquinarias.show')
                <!-- Formulario Vehiculo -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardMaquinaria" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="font-weight-bold text-primary">
                                    Datos Del Vehiculo:
                                    <h6 class="m-0 font-weight-bold text-dark">
                                        {{ $maquinaria->codigo_nro_gad }}
                                    </h6>
                                </h6>
                            </a>
                        <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardMaquinaria">
                                <div class="card-body">

                                    {{-- Codigo GAD --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo GAD</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $maquinaria->codigo_nro_gad }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                            </div>
                                        </div>

                                    {{-- Placa --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Placa</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $maquinaria->placa }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                            </div>
                                        </div>

                                    {{-- Marca --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Marca</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $maquinaria->marcas->marca }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                            </div>
                                        </div>

                                    {{-- Modelo --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Modelo</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $maquinaria->modelo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                            </div>
                                        </div>

                                    {{-- Año --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Año</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $maquinaria->anio }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                            </div>
                                        </div>

                                    {{-- Kilometraje --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Kilometraje</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $maquinaria->kilometraje }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                            </div>
                                        </div>

                                    {{-- Tipo --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Tipo</label>
                                            <div class="col-md-6">
                                                <input type="input" disabled value="{{ $maquinaria->tipo_vehiculo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                            </div>
                                        </div>

                                    {{-- Operario --}}
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Operador del Vehiculo</label>
                                            <div class="col-md-6">
                                                @if ($maquinaria->operarios)
                                                    <input type="input" disabled value="{{ $maquinaria->operarios->first()->name }} {{ $maquinaria->operarios->first()->apellido_pater }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                @else
                                                    <input type="input" disabled value="N/A" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                @endif
                                            </div>
                                        </div>

                                    {{-- Observacion --}}
                                        <div class="form-group row">
                                            <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                            <div class="col-md-6">
                                                <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $maquinaria->observacion }} </textarea>
                                            </div>
                                        </div>

                                    {{-- btn--}}
                                        <div class="form-group row mb-0">
                                            <div class="align-maquinarias-center col-md-6 offset-md-6">
                                                @can('maquinarias.edit')
                                                    <a href="{{ route('maquinarias.edit', Hashids::encode($maquinaria->id)) }}" class="btn btn-sm btn-warning">
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
            @can('operarios.show')
                <!-- Formulario Operador -->
                    @if (@$maquinaria->operarios)
                        <!-- Divider -->
                            <div class="sidebar-heading text-center">
                                Operador
                            </div>
                            <hr class="sidebar-divider">
                        <!-- Body -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                    <a href="#collapseCardOperador" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                        <h6 class="font-weight-bold text-primary">
                                            Datos Del Operador Del Vehiculo:
                                            <h6 class="m-0 font-weight-bold text-dark">
                                                {{ $maquinaria->operarios->name }} {{ $maquinaria->operarios->apellido_pater }} {{ $maquinaria->operarios->apellido_mater }}
                                            </h6>
                                        </h6>
                                    </a>
                                <!-- Card Content - Collapse -->
                                    <div class="collapse hide" id="collapseCardOperador">
                                        <div class="card-body">

                                            {{-- Cedula --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Cedula del solicitante</label>
                                                    <div class="col-md-6">
                                                        <input id="codigo" type="text" class="form-control" disabled value="{{ $maquinaria->operarios->cedula }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Nombre--}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Nombre del solicitante</label>
                                                    <div class="col-md-6">
                                                        <input id="codigo" type="text" class="form-control" disabled value="{{ $maquinaria->operarios->name }} {{ $maquinaria->operarios->apellido_pater }} {{ $maquinaria->operarios->apellido_mater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Direccion --}}
                                                <div class="form-group row">
                                                    <label for="direc" class="col-md-4 col-form-label text-md-right">Direccion</label>

                                                    <div class="col-md-6">
                                                        <input id="direc" type="text" class="form-control" disabled value="{{ $maquinaria->operarios->direc }}" name="direc" required autofocus>
                                                    </div>
                                                </div>

                                            {{-- Telefono --}}
                                                <div class="form-group row">
                                                    <label for="tlf" class="col-md-4 col-form-label text-md-right">Telefono</label>

                                                    <div class="col-md-6">
                                                        <input id="tlf" type="text" class="form-control" disabled value="{{ $maquinaria->operarios->tlf }}" name="tlf" required autofocus>
                                                    </div>
                                                </div>

                                            {{-- Tipo Contrato --}}
                                                <div class="form-group row">
                                                    <label for="tlf" class="col-md-4 col-form-label text-md-right">Tipo Contrato</label>

                                                    <div class="col-md-6">
                                                        <input id="tlf" type="text" class="form-control" disabled value="{{ $maquinaria->operarios->tipo_contrato }}" name="tlf" required autofocus>
                                                    </div>
                                                </div>

                                            {{-- Tipo Contrato --}}
                                                <div class="form-group row">
                                                    <label for="tlf" class="col-md-4 col-form-label text-md-right">Tipo Licencia</label>

                                                    <div class="col-md-6">
                                                        <input id="tlf" type="text" class="form-control" disabled value="{{ $maquinaria->operarios->tipo_licencia }}" name="tlf" required autofocus>
                                                    </div>
                                                </div>

                                            {{-- btn--}}
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-5">
                                                        @can('operarios.show')
                                                            <a href="{{ route('operarios.show', Hashids::encode($maquinaria->operarios->id)) }}" class="btn btn-sm btn-info">
                                                                <i class="fas fa-fw fa-eye"></i>
                                                                Ver
                                                            </a>
                                                        @endcan
                                                        @can('operarios.edit')
                                                            <a href="{{ route('operarios.edit', Hashids::encode($maquinaria->operarios->id)) }}" class="btn btn-sm btn-warning">
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
            @can('tareas.show')
                <!-- Formulario Tareas -->
                    @if(@$maquinaria->tareas->first())
                        <!-- Divider -->
                            <div class="sidebar-heading text-center">
                                Requerimientos
                            </div>
                            <hr class="sidebar-divider">
                        <!-- Body -->
                            <div class="row">
                                @foreach (@App\Maquinaria::findOrFail($maquinaria->id)->tareas as $item)
                                    @if ($item->estado != 'Finalizada' && $item->estado != 'Abandonado')
                                        
                                        <div class="col-lg-6">
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Accordion -->
                                                    @switch($item->estado)
                                                        @case('En Proceso')
                                                            <a href="#collapseCardTareas{{$loop->iteration}}" class="d-block card-header py-3 border-left-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                                <h6 class="m-0 font-weight-bold text-primary">
                                                                    Datos Del Requerimiento:
                                                                    <h6 class="m-0 font-weight-bold text-dark"><i>{{ $item->fake_id}}</i></h6>
                                                                </h6>
                                                            </a>
                                                            @break
                                                        @case('Pendiente')
                                                            <a href="#collapseCardTareas{{$loop->iteration}}" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                                <h6 class="m-0 font-weight-bold text-primary">
                                                                    Datos Del Requerimiento:
                                                                    <h6 class="m-0 font-weight-bold text-dark"><i>{{ $item->fake_id}}</i></h6>
                                                                </h6>
                                                            </a>
                                                            @break
                                                        @default
                                                            <a href="#collapseCardTareas{{$loop->iteration}}" class="d-block card-header py-3 border-left-secondary" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                                <h6 class="m-0 font-weight-bold text-primary">
                                                                    Datos Del Requerimiento:
                                                                    <h6 class="m-0 font-weight-bold text-dark"><i>{{ $item->fake_id}}</i></h6>
                                                                </h6>
                                                            </a>
                                                    @endswitch
                                                        
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
                                                                    <label for="observacion" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                                    <div class="col-md-6">
                                                                        <textarea type="text" disabled class="form-control" required autocomplete="observacion" autofocus> {{ $item->observacion }} </textarea>
                                                                    </div>
                                                                </div>

                                                            {{-- Estado --}}
                                                                <div class="form-group row">
                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado</label>
                                                                    <div class="col-md-6">
                                                                        <input type="input" disabled value="{{ $item->estado }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                    </div>
                                                                </div>

                                                            {{-- btn--}}
                                                                <div class="form-group row mb-0">
                                                                    <div class="col-md-6 offset-md-5">
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
                                                                </div>

                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        
                                    @endif
                                @endforeach
                            </div>
                    @endif
            @endcan
        </div>
    </div>
</form>

@endsection
