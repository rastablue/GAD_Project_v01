@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Nuevo Trabajo</b></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('trabajos.store') }}">
                        @csrf

                        {{-- Codigo del Mantenimiento --}}
                            <input id="codigo" type="hidden" name="codigo" value="{{ $mantenimiento->id }}">

                        {{-- Codigo Mantenimiento --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Mantenimiento</label>
                                <div class="col-md-6">
                                    <input type="input" disabled value="{{ $mantenimiento->codigo }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                </div>
                            </div>

                        {{-- Mano de Obra --}}
                            <div class="form-group row">
                                <label for="Mano De Obra" class="col-md-4 col-form-label text-md-right">{{ __('Mano De Obra') }}</label>
                                <div class="col-md-6">
                                    <textarea type="text" name="mano_de_obra" class="form-control @error('mano_de_obra') is-invalid @enderror" autocomplete="Mano De Obra" autofocus>{{ old('mano_de_obra') }}</textarea>

                                    @error('mano_de_obra')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Repuestos --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Repuestos') }}</label>
                                <div class="col-md-6">
                                    <textarea type="text" name="repuestos" class="form-control @error('repuestos') is-invalid @enderror" autocomplete="Repuestos" autofocus> {{ old('repuestos') }} </textarea>

                                    @error('repuestos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Costo Mano De Obra --}}
                            <div class="form-group row">
                                <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Costo De Mano De Obra') }}</label>
                                <div class="col-md-6">
                                    <input type="number" step="any" name="costo_mano_de_obra" value="{{ old('costo_mano_de_obra') }}" class="form-control @error('costo_mano_de_obra') is-invalid @enderror" autocomplete="Costo de Mano de Obra" autofocus>

                                    @error('costo_mano_de_obra')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Costo Repuestos --}}
                            <div class="form-group row">
                                <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Costo De Repuestos') }}</label>
                                <div class="col-md-6">
                                    <input type="number" step="any" name="costo_de_repuestos" value="{{ old('costo_de_repuestos') }}" class="form-control @error('costo_de_repuestos') is-invalid @enderror" autocomplete="Costo de Repuestos" autofocus>


                                    @error('costo_de_repuestos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Estado --}}
                            <div class="form-group row">
                                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                                <div class="col-md-6">

                                    <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado">
                                        <option value="{{ old('estado') }}" selected>{{ old('estado') }}</option>
                                        @foreach(App\Trabajo::getEnumValues('trabajos', 'estado') as $estado)
                                            <option value="{{ $estado }}">  {{ $estado }}  </option>
                                        @endforeach
                                    </select>

                                    @error('estado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                        {{-- Tipo --}}
                            <div class="form-group row">
                                <label for="tipo_contrato" class="col-md-4 col-form-label text-md-right">{{ __('Tipo De Trabajo') }}</label>

                                <div class="col-md-6">

                                    <select id="tipo" class="form-control @error('tipo') is-invalid @enderror" name="tipo">
                                        <option value="{{ old('tipo') }}" selected>{{ old('tipo') }}</option>
                                        @foreach(App\Trabajo::getEnumValues('trabajos', 'tipo') as $tipo)
                                            <option value="{{ $tipo }}">  {{ $tipo }}  </option>
                                        @endforeach
                                    </select>


                                    @error('tipo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                        {{-- btn--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
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
