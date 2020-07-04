@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-tareas-center">
                    <span><h4><b>Actualizar Requerimiento de: </b><i>{{ $tarea->solicituds->codigo_solicitud }}</i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tareas.update', $tarea->id) }}">
                        @method('PUT')
                        @csrf

                        {{-- Codigo Solicitud --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Solicitud</label>
                                <div class="col-md-6">
                                    <input type="text" disabled value="{{ $tarea->solicituds->codigo_solicitud }}" class="form-control" autofocus>
                                </div>
                            </div>

                        {{-- Codigo Tarea --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Requerimiento</label>
                                <div class="col-md-6">
                                    <input type="text" disabled value="{{ $tarea->fake_id }}" class="form-control" autofocus>
                                </div>
                            </div>

                        {{-- Fecha Inicio --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Inicio</label>
                                <div class="col-md-6">
                                    <input type="date" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ $tarea->fecha_inicio ?? old('fecha_inicio') }}" autocomplete="Fecha inicio" autofocus>
                                
                                    @error('fecha_inicio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Fecha Fin --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Fin</label>
                                <div class="col-md-6">
                                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" value="{{ $tarea->fecha_fin ?? old('fecha_fin') }}" autocomplete="Fecha fin" autofocus>
                                
                                    @error('fecha_fin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Direccion --}}
                            <div class="form-group row">
                                <label for="detalle" class="col-md-4 col-form-label text-md-right">Direccion</label>
                                <div class="col-md-6">
                                    <textarea type="text" name="direccion" placeholder="{{ $tarea->direc_tarea }}" class="form-control @error('direccion') is-invalid @enderror" autocomplete="direccion" autofocus>{{ $tarea->direc_tarea ?? old('direccion') }}</textarea>
                                
                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Detalle --}}
                            <div class="form-group row">
                                <label for="detalle" class="col-md-4 col-form-label text-md-right">Detalle</label>
                                <div class="col-md-6">
                                    <textarea type="text" name="detalle" placeholder="{{ $tarea->detalle }}" class="form-control @error('detalle') is-invalid @enderror" autocomplete="detalle" autofocus>{{ $tarea->detalle ?? old('detalle') }}</textarea>
                                
                                    @error('detalle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Observacion --}}
                            <div class="form-group row">
                                <label for="observacion" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                <div class="col-md-6">
                                    <textarea type="text" name="observacion" placeholder="{{ $tarea->observacion }}" class="form-control @error('observacion') is-invalid @enderror" autocomplete="observacion" autofocus>{{ $tarea->observacion ?? old('observacion') }}</textarea>
                                
                                    @error('observacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Estado --}}
                            <div class="form-group row">
                                <label for="tipo_contrato" class="col-md-4 col-form-label text-md-right">Estado</label>

                                <div class="col-md-6">

                                    <select class="form-control @error('estado') is-invalid @enderror" name="estado">
                                        <option disabled>Seleccione un Estado</option>
                                        <option selected='true'>{{ $tarea->estado }}</option>
                                        @foreach(App\Tarea::getEnumValues('tareas', 'estado') as $estados)
                                            <option value="{{ $estados }}">  {{ $estados }}  </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                        {{-- btn--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
