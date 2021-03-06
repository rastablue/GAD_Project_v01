@extends('layouts.app')

@section('content')

    @php
        $incrementa = 100;
        $tareas_pendientes = 0;
    @endphp
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Asignar Maquinarias al Requerimiento:
                <a href="javascript:history.back()">
                    <img class="img-responsive img-rounded float-right" src="{{ asset('images/retroceder.png') }}">
                </a>
                <h6 class="m-0 font-weight-bold text-dark">
                    {{ $tarea->fake_id }}
                </h6>
            </h5>
        </div>
        <div class="card-body">
            {!! Form::model($tarea, ['route' => ['asigna.store', Hashids::encode($tarea->id)]]) !!}
            <div class="form-group">
                <ul class="list-unstyled">
                    @foreach ($maquinaria as $item)
                        @if (count($item->mantenimientos->where('estado', 'Activo')) >= 1 
                          || count($item->mantenimientos->where('estado', 'En espera')) >= 1 
                          || count($item->mantenimientos->where('estado', 'Inactivo')) >= 1)
                        @else
                            @if (!$item->tareas->first())

                                <div class="row">

                                    <div class="col-lg-0">
                                        <div class="card shadow mb-2">
                                            <!-- Boton check para seleccionar el vehiculo -->
                                                <div class="d-block card-header py-4 border-bottom-info">
                                                    {{ Form::checkbox('maquinarias[]', $item->id, null) }}
                                                    <input id="tarea" type="hidden" name="tarea" value="{{ $tarea->id }}">
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-11">
                                        <div class="card shadow mb-2">
                                            <!-- Card Header - Accordion -->
                                                <a href="#collapseCardTarea{{ $loop->iteration }}" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                    <h6 class="font-weight-bold text-primary">
                                                        Datos Del Vehiculo:
                                                        <h6 class="m-0 font-weight-bold text-dark">
                                                            <em>{{ $item->codigo_nro_gad }} - {{ $item->tipo_vehiculo }}</em>
                                                        </h6>
                                                    </h6>
                                                </a>

                                            <!-- Informacion con la lista de los vehiculos -->
                                                <div class="collapse hide" id="collapseCardTarea{{ $loop->iteration }}">
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
                                                                    <input type="input" disabled value="{{ $item->modelo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
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

                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                                </div>

                            @else
                                
                                @foreach (@App\Maquinaria::where('id', $item->id)->get() as $item)
                                    
                                    <div class="row">

                                        <div class="col-lg-0">
                                            <div class="card shadow mb-2">
                                                <!-- Boton check para seleccionar el vehiculo -->
                                                    <div class="d-block card-header py-4 border-bottom-info">
                                                        {{ Form::checkbox('maquinarias[]', $item->id, null) }}
                                                        <input id="tarea" type="hidden" name="tarea" value="{{ $tarea->id }}">
                                                    </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-11">
                                            @if (!$tarea->maquinarias->where('id', $item->id)->first())
                                                {{ !$tarea->maquinarias->where('id', $item->id) }}
                                            @endif
                                            <div class="card shadow mb-2">
                                                <!-- Card Header - Accordion -->
                                                    <a href="#collapseCardTarea{{ $incrementa }}" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                        <h6 class="font-weight-bold text-primary">
                                                            Datos Del Vehiculo:
                                                            @if (!$tarea->maquinarias->where('id', $item->id)->first())
                                                                @if ($item->tareas->first()->estado !== 'Finalizada' && $item->tareas->first()->estado !== 'Abandonado')
                                                                    <span class="badge badge-danger float-right" data-toggle="tooltip"
                                                                    data-placement="top" title="Parece que esta maquinaria ya cuenta con una tarea!">Importante</span>
                                                                @endif
                                                            @endif
                                                            <h6 class="m-0 font-weight-bold text-dark">
                                                                <em>{{ $item->codigo_nro_gad }} - {{ $item->tipo_vehiculo }}</em>
                                                            </h6>
                                                        </h6>
                                                    </a>
    
                                                <!-- Informacion con la lista de los vehiculos -->
                                                    <div class="collapse hide" id="collapseCardTarea{{ $incrementa }}">
                                                        <div class="card-body">
                                                            {{-- Alerta en caso de tener una fecha asignada en otro requerimiento --}}
                                                                @if (!$tarea->maquinarias->where('id', $item->id)->first())
                                                                    @foreach ($item->tareas as $item2)
                                                                        @if ($item2->estado !== 'Finalizada' && $item2->estado !== 'Abandonado')
                                                                            @php
                                                                                $tareas_pendientes += 1;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                    @if ($tareas_pendientes >= 1)
                                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                            <strong>Tenemos un problema!.</strong> Este vehiculo ya fue asignado a otro requerimiento, 
                                                                            por favor, asegurese de que las fechas no coincidan y de que la maquinaria estara disponible en ese momento.
                                                                            <br><br>
                                                                        </div>
                                                                    @endif
                                                                    @foreach ($item->tareas as $item2)
                                                                        @if ($item2->estado !== 'Finalizada' && $item2->estado !== 'Abandonado')
                                                                            <!-- Default dropright button -->
                                                                            <div class="btn-group dropright ml-3">
                                                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    {{ $item2->fake_id }}
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                <!-- Dropdown menu links -->
                                                                                    <a href="{{ route('solicituds.show', Hashids::encode($item2->solicituds->id)) }}" 
                                                                                        class="dropdown-item" target="_blank">
                                                                                        <i class="fas fa-fw fa-eye"></i>
                                                                                        ver
                                                                                    </a>
                                                                                    <hr>
                                                                                    <a class="dropdown-item">
                                                                                        <i class="fas fa-fw fa-calendar-alt"></i>
                                                                                        Inicio: &nbsp;<i class="text-right">{{ $item2->fecha_inicio }}</i>
                                                                                    </a>
                                                                                    <a class="dropdown-item">
                                                                                        <i class="fas fa-fw fa-calendar-alt"></i>
                                                                                        Fin: &nbsp;&nbsp;&nbsp;&nbsp;<i class="text-right">{{ $item2->fecha_fin }}</i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @endif    
                                                            
                                                            @if ($tareas_pendientes >= 1)
                                                                <br><hr><br>
                                                            @endif
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
                                                                        <input type="input" disabled value="{{ $item->modelo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
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
    
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
    
                                    </div>
                                    @php
                                        $incrementa += 1;
                                    @endphp
                                    @break;
                                @endforeach

                            @endif
                        @endif
                    @endforeach
                </ul>
                
                {{-- Button --}}
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-5">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
