@extends('layouts.app')

@section('content')
@php
    $tareas_pendientes = 0;
@endphp

<form id="formAgregarCliente" method="POST" action="{{ route('mantenimientos.confirmaStore') }}">
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
                                    <em>La maquinaria seleccionada ({{ $maquinaria->codigo_nro_gad }}), posee uno o mas requerimientos activos, 
                                        crear este mantenimiento provocara que la maquinaria no se encuentre disponible temporalmente.
                                        <br><hr>
                                        <div class="text-left ml-2">
                                            <strong>Requerimientos:</strong>
                                            @if (@$maquinaria->tareas->first())
                                                @foreach ($maquinaria->tareas as $item)
                                                    @if ($item->estado == 'Pendiente' || $item->estado == 'En Proceso')
                                                        @php
                                                            $tareas_pendientes += 1;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if (@$tareas_pendientes >= 1)
                                                @foreach ($maquinaria->tareas as $item)
                                                    @if ($item->estado == 'Pendiente' || $item->estado == 'En Proceso')
                                                        <br><a href="{{ route('solicituds.show', Hashids::encode($item->solicituds->id)) }}" target="_blank">
                                                            {{ $item->fake_id }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        <br>
                                        <strong>¿Desea continuar?</strong>
                                        <br><br>
                                    </em>
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
                            <h6 class="m-0 font-weight-bold text-primary">Datos del Mantenimiento</h6>
                        </a>
                    <!-- Card Content - Collapse -->
                        <div class="collapse hide" id="collapseCardExample">
                            <div class="card-body">

                                {{-- Vehiculo seleccionado --}}
                                    <div class="form-group row">
                                        <label for="cedula" class="col-md-3 col-form-label text-md-right">Maquinaria</label>
                                        <div class="col-md-6">
                                            <input type="text" disabled class="form-control @error('maquinaria') is-invalid @enderror" value="{{ $maquinaria->codigo_nro_gad }}" autofocus>
                                        
                                            @error('maquinaria')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <input type="hidden" name="maquinaria" value="{{ $maquinaria->id }}">

                                {{-- Valor Total --}}
                                    <div class="form-group row">
                                        <label for="cedula" class="col-md-3 col-form-label text-md-right">Valor Total</label>
                                        <div class="col-md-6">
                                            <input type="text" disabled class="form-control @error('valor_total') is-invalid @enderror" value="{{ $request->valor_total }}" autofocus>
                                        
                                            @error('valor_total')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <input type="hidden" name="valor_total" value="{{ $request->valor_total }}">
                                        </div>
                                    </div>

                                {{-- Diagnostico --}}
                                    <div class="form-group row">
                                        <label for="diagnostico" class="col-md-3 col-form-label text-md-right">Diagnostico</label>
                                        <div class="col-md-6">
                                            <textarea type="text" disabled class="form-control @error('diagnostico') is-invalid @enderror" name="diagnostico" autofocus>{{ $request->diagnostico ?? old('diagnostico') }}</textarea>

                                            @error('diagnostico')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <input type="hidden" name="diagnostico" value="{{ $request->diagnostico }}">

                                        </div>
                                    </div>

                                {{-- Observacion --}}
                                    <div class="form-group row">
                                        <label for="observacion" class="col-md-3 col-form-label text-md-right">Observacion</label>
                                        <div class="col-md-6">
                                            <textarea type="text" disabled class="form-control @error('observacion') is-invalid @enderror" name="observacion" autofocus>{{ $request->observacion ?? old('observacion') }}</textarea>

                                            @error('observacion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

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
