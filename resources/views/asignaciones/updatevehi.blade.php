@extends('layouts.app')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Asignar vehiculos al Operario:
                <a href="javascript:history.back()">
                    <img class="img-responsive img-rounded float-right" src="{{ asset('images/retroceder.png') }}">
                </a>
                <h6 class="m-0 font-weight-bold text-dark">
                    {{ $operario->name }} {{ $operario->apellido_pater }} {{ $operario->apellido_mater }}
                </h6>
            </h5>
        </div>
        <div class="card-body">
            {!! Form::model($operario, ['route' => ['asignavehi.store', Hashids::encode($operario->id)]]) !!}
            <div class="form-group">
                <ul class="list-unstyled">
                    @foreach ($maquinaria as $item)
                        <div class="row">

                            <div class="col-lg-0">
                                <div class="card shadow mb-2">
                                    <!-- Boton check para seleccionar el vehiculo -->
                                        <div class="d-block card-header py-4 border-bottom-info">
                                            {{ Form::checkbox('maquinarias[]', $item->id, null) }}
                                            <input id="operario" type="hidden" name="operario" value="{{ $operario->id }}">
                                        </div>
                                </div>
                            </div>

                            <div class="col-lg-11">
                                <div class="card shadow mb-2">

                                    <!-- Card Header - Accordion -->
                                        <a href="#collapseCardTarea{{ $loop->iteration }}" class="d-block card-header py-3 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <h6 class="font-weight-bold text-primary">
                                                Datos Del Vehiculo:
                                                @if ($item->operarios)
                                                    <span class="badge badge-primary float-right">Operador ya asignado</span>
                                                @endif
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

                                                {{-- Operario --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Operador del Vehiculo</label>
                                                        <div class="col-md-6">
                                                            @if ($item->operarios)
                                                                <input type="input" disabled value="{{ $item->operarios->name }} {{ $item->operarios->apellido_pater }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                            @else
                                                                <input type="input" disabled value="N/A" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                            @endif
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

@endsection
