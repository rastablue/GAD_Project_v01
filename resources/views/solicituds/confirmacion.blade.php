@extends('layouts.app')

@section('content')

<form id="formAgregarCliente" method="GET" action="{{ route('solicituds.createcliente') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Formulario Cliente -->
                <div class="card shadow mb-4">

                    <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Confirmacion</h6>
                        </a>

                    <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">
                                <div class="text-center">
                                    <em>La cedula proporcionada ({{ $request->cedula }}), no pertenece a ningun solicitante registrado, desea registrar al solicitante y crear la Solicitud<br><br></em>
                                </div>

                                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                                <button type="submit" form="formAgregarCliente" id="submitBtn" class="btn btn-primary">Agregar</button>

                            </div>
                        </div>

                </div>

            <!-- Formulario Solicitudes -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Datos de la Solicitud</h6>
                        </a>
                    <!-- Card Content - Collapse -->
                        <div class="collapse hide" id="collapseCardExample">
                            <div class="card-body">
                                {{-- cedula --}}
                                    <div class="form-group row">
                                        <label for="cedula" class="col-md-3 col-form-label text-md-right">Cedula</label>
                                        <div class="col-md-6">
                                            <input type="text" disabled class="form-control @error('cedula') is-invalid @enderror" value="{{ $request->cedula }}" autofocus>
                                        
                                            @error('cedula')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <input type="hidden" name="cedula" value="{{ $request->cedula }}">

                                {{-- Fecha_inicio --}}
                                    <div class="form-group row">
                                        <label for="cedula" class="col-md-3 col-form-label text-md-right">Fecha de Inicio</label>
                                        <div class="col-md-6">
                                            <input type="text" disabled class="form-control @error('cedula') is-invalid @enderror" value="{{ $request->fecha_inicio }}" autofocus>
                                        
                                            @error('cedula')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <input type="hidden" name="fecha_inicio" value="{{ $request->fecha_inicio }}">
                                        </div>
                                    </div>

                                {{-- Fecha_fin --}}
                                    <div class="form-group row">
                                        <label for="cedula" class="col-md-3 col-form-label text-md-right">Fecha de Fin</label>
                                        <div class="col-md-6">
                                            <input type="text" disabled class="form-control @error('cedula') is-invalid @enderror" value="{{ $request->fecha_fin }}" autofocus>
                                        
                                            @error('cedula')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <input type="hidden" name="fecha_fin" value="{{ $request->fecha_fin }}">
                                        </div>
                                    </div>

                                {{-- Detalle --}}
                                    <div class="form-group row">
                                        <label for="detalle" class="col-md-3 col-form-label text-md-right">Detalle</label>
                                        <div class="col-md-6">
                                            <textarea type="text" disabled class="form-control" name="detalle" autofocus>{{ $request->detalle ?? old('detalle') }}</textarea>

                                            <input type="hidden" name="detalle" value="{{ $request->detalle }}">

                                        </div>
                                    </div>

                                {{-- Observacion --}}
                                    <div class="form-group row">
                                        <label for="observacion" class="col-md-3 col-form-label text-md-right">Observacion</label>
                                        <div class="col-md-6">
                                            <textarea type="text" disabled class="form-control" name="observacion" autofocus>{{ $request->observacion ?? old('observacion') }}</textarea>

                                            <input type="hidden" name="observacion" value="{{ $request->observacion }}">
                                        </div>
                                    </div>
                            </div>
                        </div>
                </div>

        </div>
    </div>
</form>
<script>
    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
</script>
@endsection
