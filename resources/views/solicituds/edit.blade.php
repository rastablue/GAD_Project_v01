@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Actualizar Solicitud: </b><i>{{ $solicitud->codigo_solicitud }}</i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('solicituds.update', $solicitud->id) }}">
                        @method('PUT')
                        @csrf

                        {{-- Codigo --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled value="{{ $solicitud->codigo_solicitud }}" placeholder="{{ $solicitud->codigo_solicitud }}" autocomplete="Codigo" autofocus>
                                </div>
                            </div>

                        {{-- Nombre Solicitante --}}
                            <div class="form-group row">
                                <label for="user_id" class="col-md-4 col-form-label text-md-right">Nombre del Solicitante</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" disabled value="{{ $solicitud->clientes->name }}  {{ $solicitud->clientes->apellido_pater }}">
                                </div>
                            </div>

                        {{-- Cedula Solicitante --}}
                            <div class="form-group row">
                                <label for="user_id" class="col-md-4 col-form-label text-md-right">Cedula del Solicitante</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('cedula') is-invalid @enderror" value="{{ $solicitud->clientes->cedula ?? old('cedula') }}" placeholder="{{ $solicitud->clientes->cedula }}" name="cedula" autofocus>
                                    
                                    @error('cedula')
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
                                    <textarea type="text" class="form-control @error('detalle') is-invalid @enderror" name="detalle" value="{{ $solicitud->detalle }}" placeholder="{{ $solicitud->detalle }}" autocomplete="detalle" autofocus>{{ $solicitud->detalle }}</textarea>
                                
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
                                    <textarea type="text" class="form-control @error('observacion') is-invalid @enderror" name="observacion" value="{{ $solicitud->observacion }}" placeholder="{{ $solicitud->observacion }}" autocomplete="observacion" autofocus>{{ $solicitud->observacion }}</textarea>
                                
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

                                    <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado">
                                        <option disabled>Seleccione un Estado</option>
                                        <option selected='true'>{{ $solicitud->estado }}</option>
                                        @foreach(App\Solicitud::getEnumValues('solicituds', 'estado') as $estados)
                                            <option value="{{ $estados }}">  {{ $estados }}  </option>
                                        @endforeach
                                    </select>
                                    
                                    @error('estado')
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
