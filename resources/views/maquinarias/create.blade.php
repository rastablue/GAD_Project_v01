@extends('layouts.app')

@section('content')
<form id="formSolicitud" method="POST" action="{{ route('maquinarias.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Formulario Mantenimiento -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                        <a href="" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Agregar Vehiculo</h6>
                        </a>
                    <!-- Card Content - Collapse -->
                        <div class="collapse show">
                            <div class="card-body">

                                {{-- Codigo GAD --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Codigo') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="codigo" value="{{ old('codigo') }}" onkeyup="mayus(this);" class="form-control @error('codigo') is-invalid @enderror" autocomplete="codigo" autofocus>

                                            @error('codigo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Placa --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="placa" value="{{ old('placa') }}" onkeyup="mayus(this);" class="form-control @error('placa') is-invalid @enderror" autocomplete="Placa" autofocus>

                                            @error('placa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Marca --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}</label>
                                        <div class="col-md-6">
                                            <select id="marca" class="form-control @error('marca') is-invalid @enderror" name="marca">
                                                <option selected disabled>Seleccione una Marca</option>
                                                @foreach(App\Marca::all() as $marcas)
                                                    <option value="{{ $marcas->id }}">  {{ $marcas->marca }}  </option>
                                                @endforeach

                                                @error('marca')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </select>
                                        </div>
                                    </div>

                                {{-- Modelo --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="modelo" value="{{ old('modelo') }}" class="form-control @error('modelo') is-invalid @enderror" autocomplete="Fecha fin" autofocus>

                                            @error('modelo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Anio --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Año') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="anio" value="{{ old('anio') }}" class="form-control @error('anio') is-invalid @enderror" autocomplete="anio" autofocus>

                                            @error('anio')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Kilometraje --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Kilometraje') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="kilometraje" value="{{ old('kilometraje') }}" class="form-control @error('kilometraje') is-invalid @enderror" autocomplete="Kilometraje" autofocus>

                                            @error('kilometraje')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Tipo --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo Vehiculo') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="tipo" value="{{ old('tipo') }}" class="form-control @error('tipo') is-invalid @enderror" autocomplete="tipo" autofocus>

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
                                            <textarea type="text" name="observacion" class="form-control @error('observacion') is-invalid @enderror" autocomplete="Observacion" autofocus>{{ old('observacion') }}</textarea>

                                            @error('observacion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- btn--}}
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-6">
                                            <button type="submit" class="btn btn-primary">Agregar</button>
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
    $('#file-upload').bind('change', function() { var fileName = ''; fileName = $(this).val(); $('#file-selected').html(fileName); })
</script>
@endsection
