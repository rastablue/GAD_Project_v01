@extends('layouts.app')

@section('content')
@php
    $tareas_pendientes = 0;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-tareas-center">
                    <span><h4><b>Nuevo Mantenimiento al Vehiculo: </b> {{ $vehiculo->codigo_nro_gad }}</h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('mantenimientos.storefrom') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Notificacion de que el vehiculo esta en un requerimiento --}}
                            @if (@$vehiculo->tareas->first())
                                @foreach ($vehiculo->tareas as $item)
                                    @if ($item->estado == 'Pendiente' || $item->estado == 'En Proceso')
                                        @php
                                            $tareas_pendientes += 1;
                                        @endphp
                                    @endif
                                @endforeach
                            @endif
                            @if (@$tareas_pendientes >= 1)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Advertencia!.</strong> Este vehiculo esta actualmente asignado a uno o mas requerimientos, crear este 
                                    mantenimiento provocara que no se encuentre disponible temporalmente.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    @foreach ($vehiculo->tareas as $item)
                                        @if ($item->estado == 'Pendiente' || $item->estado == 'En Proceso')
                                            <br><a href="{{ route('solicituds.show', Hashids::encode($item->solicituds->id)) }}" target="_blank">
                                                {{ $item->fake_id }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                        {{-- Placa del vehiculo --}}
                            <input id="placa" type="hidden" name="placa" value="{{ $vehiculo->placa }}">

                        {{-- Placa del Vehiculo --}}
                            <div class="form-group row">

                                <label for="placa" class="col-md-4 text-md-right">Placa del Vehiculo</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('placa') is-invalid @enderror" disabled value="{{ $vehiculo->placa }}" required autocomplete="placa" autofocus>

                                    @error('placa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Valor Total --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Valor Total') }}</label>
                                <div class="col-md-6">
                                    <input type="number" step="0.01" name="valor_total" value="{{ old('valor_total') }}" class="form-control @error('valor_total') is-invalid @enderror" autocomplete="valor_total" autofocus>

                                    @error('valor_total')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Diagnostico --}}
                            <div class="form-group row">
                                <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Diagnostico') }}</label>
                                <div class="col-md-6">
                                    <textarea type="text" name="diagnostico" class="form-control @error('diagnostico') is-invalid @enderror" autocomplete="diagnostico" autofocus>{{ old('diagnostico') }}</textarea>

                                    @error('diagnostico')
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
                                    <textarea type="text" name="observacion" class="form-control @error('observacion') is-invalid @enderror" autocomplete="observacion" autofocus>{{ old('observacion') }}</textarea>

                                    @error('observacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Foto de la Ficha 
                            <div class="form-group" style="margin-left: 360px;">
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i> Agregar imagen de la ficha
                                </label>
                                <span id="file-selected"></span>
                                <input id="file-upload" accept="image/jpeg,image/png" type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}" autofocus>

                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>--}}

                        {{-- btn--}}
                            <div class="form-group row mb-0" style="margin-left: 15px;">
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
<script>
    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
    $('#file-upload').bind('change', function() { var fileName = ''; fileName = $(this).val(); $('#file-selected').html(fileName); })
</script>
@endsection
