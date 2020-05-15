@extends('layouts.app')

@section('content')
<form id="formSolicitud" method="POST" action="{{ route('mantenimientos.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Formulario Mantenimiento -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                        <a href="" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Nuevo Mantenimiento</h6>
                        </a>
                    <!-- Card Content - Collapse -->
                        <div class="collapse show">
                            <div class="card-body">

                                {{-- Fecha Ingreso 
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Ingreso') }}</label>
                                        <div class="col-md-6">
                                            <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}" class="form-control @error('fecha_ingreso') is-invalid @enderror" autocomplete="Fecha inicio" autofocus>

                                            @error('fecha_ingreso')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>--}}

                                {{-- Fecha Egreso
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Egreso') }}</label>
                                        <div class="col-md-6">
                                            <input type="date" name="fecha_egreso" value="{{ old('fecha_egreso') }}" class="form-control @error('fecha_egreso') is-invalid @enderror" autocomplete="Fecha inicio" autofocus>

                                            @error('fecha_egreso')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}

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

                                {{-- Vehiculo --}}
                                    <div class="form-group row">
                                        <label for="vehiculo" class="col-md-4 col-form-label text-md-right">{{ __('Vehiculo') }}</label>
                                        <div class="col-md-6">

                                            <select name="maquinaria" class="form-control @error('maquinaria') is-invalid @enderror">
                                                @foreach (@App\Maquinaria::all() as $item)
                                                    <option value="{{ $item->id }}">{{ $item->codigo_nro_gad }} | {{ $item->modelo }}</option>
                                                @endforeach
                                            </select>

                                            @error('maquinaria')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Foto de la Ficha --}}
                                    <div class="form-group" style="margin-left: 290px;">
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
                                    </div>

                                {{-- Botones --}}
                                    <div class="text-center" style="margin-left: 120px;">
                                        <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                                        <button type="submit" form="formSolicitud" id="submitBtn" class="btn btn-primary">Agregar</button>
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
    $('#file-upload').bind('change', function() { var fileName = ''; fileName = $(this).val(); $('#file-selected').html(fileName); })
</script>
@endsection
