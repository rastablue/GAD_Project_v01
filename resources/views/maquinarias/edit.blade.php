@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-tareas-center">
                    <span><h4><b>Actualizar vehiculo: </b><i>{{ $maquinaria->placa }}</i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('maquinarias.update', $maquinaria->id) }}">
                        @method('PUT')
                        @csrf

                        {{-- Codigo GAD --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo GAD</label>
                                <div class="col-md-6">
                                    <input type="input" disabled id="codigo" value="{{$maquinaria->codigo_nro_gad}}" placeholder="{{$maquinaria->codigo_nro_gad}}" class="form-control" required autocomplete="codigo" autofocus>
                                </div>
                            </div>

                        {{-- Placa --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Placa</label>
                                <div class="col-md-6">
                                    <input type="input" disabled id="placa" value="{{$maquinaria->placa}}" placeholder="{{$maquinaria->placa}}" class="form-control" required autocomplete="placa" autofocus>
                                </div>
                            </div>

                        {{-- Marca --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Marca</label>
                                <div class="col-md-6">
                                    @if ($maquinaria->marca_id)
                                        <input type="input" disabled value="{{ $maquinaria->marcas->marca }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                    @else
                                        <input type="input" disabled value="N/A" class="form-control" required autocomplete="Fecha fin" autofocus>
                                    @endif
                                </div>
                            </div>

                        {{-- Modelo --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Modelo</label>
                                <div class="col-md-6">
                                    <input type="input" disabled value="{{$maquinaria->modelo}} || {{ $maquinaria->anio }}" placeholder="{{$maquinaria->modelo}} || {{ $maquinaria->anio }}" class="form-control" required autocomplete="modelo" autofocus>
                                </div>
                            </div>

                        {{-- Kilometraje --}}
                            <div class="form-group row">
                                <label for="kilometraje" class="col-md-4 col-form-label text-md-right">{{ __('Kilometraje') }}</label>

                                <div class="col-md-6">
                                    <input id="kilometraje" type="text" placeholder="{{ $maquinaria->kilometraje }}" class="form-control @error('kilometraje') is-invalid @enderror" name="kilometraje" value="{{ $maquinaria->kilometraje }}" autocomplete="kilometraje" autofocus>

                                    @error('kilometraje')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Tipo --}}
                            <div class="form-group row">

                                <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

                                <div class="col-md-6">
                                    <input placeholder="{{ $maquinaria->tipo_vehiculo }}" type="text" class="form-control @error('tipo') is-invalid @enderror" name="tipo" value="{{ $maquinaria->tipo_vehiculo }}" autocomplete="tipo" autofocus>

                                    @error('tipo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Observacion --}}
                            <div class="form-group row">
                                <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Observacion') }}</label>
                                <div class="col-md-6">
                                    <textarea type="text" name="observacion" class="form-control @error('observacion') is-invalid @enderror" autocomplete="Observacion" autofocus>{{ $maquinaria->observacion }}</textarea>

                                    @error('observacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
