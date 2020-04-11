@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-tareas-center">
                    <span><h4><b>Actualizar Mantenimiento: </b><i>{{ $mantenimiento->codigo }}</i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form id="formMantenimiento" method="POST" action="{{ route('mantenimientos.update', $mantenimiento->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        {{-- Maquinaria Perteneciente --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Vehiculo</label>
                                <div class="col-md-6">
                                    <input type="input" disabled value="{{ $mantenimiento->maquinarias->codigo_nro_gad }}" placeholder="{{ $mantenimiento->maquinarias->codigo_nro_gad }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                </div>
                            </div>

                        {{-- Codigo --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Mantenimiento</label>
                                <div class="col-md-6">
                                    <input type="input" id="codigo" name="codigo" disabled value="{{ $mantenimiento->codigo }}" placeholder="{{ $mantenimiento->codigo }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                </div>
                            </div>

                        {{-- Fecha Ingreso --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Ingreso') }}</label>
                                <div class="col-md-6">
                                    <input type="date" name="fecha_ingreso" value="{{ $fecha_ingreso ?? old('fecha_ingreso') }}" placeholder="{{ $mantenimiento->fecha_ingreso }}" class="form-control @error('fecha_ingreso') is-invalid @enderror" autocomplete="Fecha inicio" autofocus>

                                    @error('fecha_ingreso')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Fecha Egreso --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Egreso') }}</label>
                                <div class="col-md-6">
                                    <input type="date" name="fecha_egreso" value="{{ $fecha_egreso ?? old('fecha_egreso') }}" class="form-control @error('fecha_egreso') is-invalid @enderror" autocomplete="Fecha inicio" autofocus>

                                    @error('fecha_egreso')
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
                                    <textarea type="text" name="observacion" class="form-control @error('observacion') is-invalid @enderror" placeholder="{{ $mantenimiento->observacion }}" autocomplete="observacion" autofocus>{{ $mantenimiento->observacion ?? old('observacion') }}</textarea>

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
                                    <textarea type="text" name="diagnostico" class="form-control @error('diagnostico') is-invalid @enderror" placeholder="{{ $mantenimiento->diagnostico }}" autocomplete="diagnostico" autofocus>{{ $mantenimiento->diagnostico ?? old('diagnostico') }}</textarea>

                                    @error('diagnostico')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Estado --}}
                            <div class="form-group row">
                                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado del Mantenimiento') }}</label>

                                <div class="col-md-6">

                                    <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado">
                                        <option selected='true'>{{ $mantenimiento->estado }}</option>
                                        @foreach(App\Trabajo::getEnumValues('mantenimientos', 'estado') as $estados)
                                            <option value="{{ $estados }}">  {{ $estados}}  </option>
                                        @endforeach
                                    </select>

                                    @error('estado')
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
                                    <input type="text" disabled value="{{ $mantenimiento->valor_total }}" class="form-control @error('fecha_egreso') is-invalid @enderror" autocomplete="Fecha inicio" autofocus>

                                    @error('valor_total')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Foto de la Ficha --}}
                            <div class="form-group" style="margin-left: 350px;">
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
                            <div class="text-center">
                                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                                <button type="submit" form="formMantenimiento" id="submitBtn" class="btn btn-primary">Actualizar</button>
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
