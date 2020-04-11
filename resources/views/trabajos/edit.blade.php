@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-tareas-center">
                    <span><h4><b>Actualizar Trabajo: </b><i>{{ $trabajo->fake_id }}</i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('trabajos.update', $trabajo->id) }}">
                        @method('PUT')
                        @csrf

                        {{-- Codigo de la Solicitud --}}
                            <input id="codigo" type="hidden" name="codigo" value="{{ $trabajo->mantenimientos->id }}">

                        {{-- Codigo Mantenimiento --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Mantenimiento</label>
                                <div class="col-md-6">
                                    <input type="input" name="codigo" pattern="[A-Za-z0-9]{7}" disabled value="{{ $trabajo->mantenimientos->codigo }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                </div>
                            </div>

                        {{-- Codigo Trabajo --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Trabajo</label>
                                <div class="col-md-6">
                                    <input type="input" name="fake_id" disabled value="{{ $trabajo->fake_id }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                </div>
                            </div>

                        {{-- Mano de Obra --}}
                            <div class="form-group row">
                                <label for="mano_de_obra" class="col-md-4 col-form-label text-md-right">{{ __('Mano de Obra') }}</label>

                                <div class="col-md-6">
                                    <textarea id="mano_de_obra" type="text" placeholder="{{ $trabajo->mano_de_obra }}" class="form-control @error('mano_de_obra') is-invalid @enderror" name="mano_de_obra" value="{{ old('mano_de_obra') }}" autocomplete="mano_de_obra" autofocus>{{ $trabajo->manobra }}</textarea>

                                    @error('mano_de_obra')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Repuestos --}}
                            <div class="form-group row">
                                <label for="repuestos" class="col-md-4 col-form-label text-md-right">{{ __('Repuestos') }}</label>

                                <div class="col-md-6">
                                    <textarea id="repuestos" type="text" placeholder="{{ $trabajo->repuestos }}" class="form-control @error('repuestos') is-invalid @enderror" name="repuestos" value="{{ old('repuestos') }}" autocomplete="repuestos" autofocus>{{ $trabajo->repuestos }}</textarea>

                                    @error('repuestos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Costo del repuesto --}}
                            <div class="form-group row">

                                <label for="costo_de_repuestos" class="col-md-4 col-form-label text-md-right">{{ __('Costo Repuestos') }}</label>

                                <div class="col-md-6">
                                    <input id="costo_de_repuestos" placeholder="{{ $trabajo->costo_repuestos }}" type="number" step="0.01" class="form-control @error('costo_de_repuestos') is-invalid @enderror" name="costo_de_repuestos" value="{{ $trabajo->costo_repuestos }}" autocomplete="costo_de_repuestos" autofocus>

                                    @error('costo_de_repuestos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Costo Mano de obra --}}
                            <div class="form-group row">

                                <label for="costo_mano_de_obra" class="col-md-4 col-form-label text-md-right">{{ __('Costo Mano de Obra') }}</label>

                                <div class="col-md-6">
                                    <input id="costo_mano_de_obra" placeholder="{{ $trabajo->costo_manobra }}" type="number" step="0.01" class="form-control @error('costo_mano_de_obra') is-invalid @enderror" name="costo_mano_de_obra" value="{{ $trabajo->costo_manobra }}" autocomplete="costo_mano_de_obra" autofocus>

                                    @error('costo_mano_de_obra')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Estado --}}
                            <div class="form-group row">
                                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado del Trabajo') }}</label>

                                <div class="col-md-6">

                                    <select id="estado" class="form-control" name="estado">
                                        <option selected='true'>{{ $trabajo->estado }}</option>
                                        @foreach(App\Trabajo::getEnumValues('trabajos', 'estado') as $estados)
                                            <option value="{{ $estados }}">  {{ $estados}}  </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                        {{-- Tipo --}}
                            <div class="form-group row">
                                <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Trabajo') }}</label>

                                <div class="col-md-6">

                                    <select id="tipo" class="form-control" name="tipo">
                                        <option selected='true'>{{ $trabajo->tipo }}</option>
                                        @foreach(App\Trabajo::getEnumValues('trabajos', 'tipo') as $tipos)
                                            <option value="{{ $tipos }}">  {{ $tipos}}  </option>
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
