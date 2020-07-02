@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Nuevo Requerimiento</b></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tareas.storefrom') }}">
                        @csrf

                        {{-- Codigo de la Solicitud --}}
                            <input id="codigo" type="hidden" name="codigo" value="{{ $solicitud->codigo_solicitud }}">

                        {{-- Codigo --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo de la solicitud</label>
                                <div class="col-md-6">
                                    <input type="text" disabled value="{{ $solicitud->codigo_solicitud }}" class="form-control @error('codigo') is-invalid @enderror" autocomplete="Codigo" autofocus>

                                    @error('codigo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Fecha Inicio --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Inicio') }}</label>
                                <div class="col-md-6">
                                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ $fecha_inicio ?? old('fecha_inicio') }}" autocomplete="Fecha inicio" autofocus>

                                    @error('fecha_inicio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Fecha Fin --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Fin') }}</label>
                                <div class="col-md-6">
                                    <input type="date" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" value="{{ $fecha_fin ?? old('fecha_fin') }}" autocomplete="Fecha fin" autofocus>

                                    @error('fecha_fin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Direccion --}}
                            <div class="form-group row">
                                <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
                                <div class="col-md-6">
                                    <textarea type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" autocomplete="direccion" autofocus>{{ $direccion ?? old('direccion') }}</textarea>

                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Detalle --}}
                            <div class="form-group row">
                                <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Detalle') }}</label>
                                <div class="col-md-6">
                                    <textarea type="text" class="form-control @error('detalle') is-invalid @enderror" name="detalle" autocomplete="detalle" autofocus>{{ $detalle ?? old('detalle') }}</textarea>

                                    @error('detalle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Observacion --}}
                            <div class="form-group row">
                                <label for="observacion" class="col-md-4 col-form-label text-md-right">{{ __('Observacion') }}</label>
                                <div class="col-md-6">
                                    <textarea type="text" class="form-control @error('observacion') is-invalid @enderror" name="observacion" autocomplete="observacion" autofocus>{{ $observacion ?? old('observacion') }}</textarea>

                                    @error('observacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Estado 
                            <div class="form-group row">
                                <label for="tipo_contrato" class="col-md-4 col-form-label text-md-right">Estado</label>

                                <div class="col-md-6">

                                    <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado">
                                        <option selected value="{{ old('estado') }}">{{ old('estado') }}</option>
                                        @foreach(App\Tarea::getEnumValues('tareas', 'estado') as $estados)
                                            <option value="{{ $estados }}">  {{ $estados }}  </option>
                                        @endforeach
                                    </select>

                                    @error('estado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>--}}

                        {{-- btn--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-6">
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
