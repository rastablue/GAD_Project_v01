@extends('layouts.app')

@section('content')
<form id="formSolicitud" method="POST" action="{{ route('solicituds.store') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Formulario Solicitudes -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Datos de la Solicitud</h6>
                        </a>
                    <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExaple">
                            <div class="card-body">
                                {{-- Codigo --}}
                                    <div class="row">
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-3 col-form-label text-md-right">Codigo</label>
                                            <div class="col-md-2">
                                                <input id="codigo1" onkeyup="mayus(this);" type="text" class="form-control @error('codigo1') is-invalid @enderror" name="codigo1" value="{{ $codigo1 ?? old('codigo1') }}" autocomplete="Codigo" autofocus>

                                                @error('codigo1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <label for="codigo" class="col-form-label">-</label>
                                            <div class="col-md-2">
                                                <input id="codigo2" onkeyup="mayus(this);" type="text" class="form-control @error('codigo2') is-invalid @enderror" name="codigo2" value="{{ $codigo2 ?? old('codigo2') }}" autocomplete="Codigo" autofocus>

                                                @error('codigo2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <label for="codigo" class="col-form-label">-</label>
                                            <div class="col-md-2">
                                                <input id="codigo3" onkeyup="mayus(this);" type="text" class="form-control @error('codigo3') is-invalid @enderror" name="codigo3" value="{{ $codigo3 ?? old('codigo3') }}" autocomplete="Codigo" autofocus>

                                                @error('codigo3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                {{-- cedula --}}
                                    <div class="form-group row">
                                        <label for="cedula" class="col-md-3 col-form-label text-md-right">Cedula del solicitante</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('cedula') is-invalid @enderror" value="{{ $cedula ?? old('cedula') }}" name="cedula" autofocus>
                                            
                                            @error('cedula')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Detalle --}}
                                    <div class="form-group row">
                                        <label for="detalle" class="col-md-3 col-form-label text-md-right">Detalle</label>
                                        <div class="col-md-6">
                                            <textarea type="text" class="form-control @error('detalle') is-invalid @enderror" name="detalle" autofocus>{{ $detalle ?? old('detalle') }}</textarea>

                                            @error('detalle')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Observacion --}}
                                    <div class="form-group row">
                                        <label for="observacion" class="col-md-3 col-form-label text-md-right">Observacion</label>
                                        <div class="col-md-6">
                                            <textarea type="text" class="form-control @error('observacion') is-invalid @enderror" name="observacion" autofocus>{{ $observacion ?? old('observacion') }}</textarea>

                                            @error('observacion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Sugerencia de Codigo --}}
                                    <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <em>*El codigo de la ficha debe constar de 3 letras y 4 numeros mas un numero o letra final. <br> -Ej. GAD-1547-3*</em>
                            </div>
                        </div>
                </div>

                <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                        <button type="submit" form="formSolicitud" id="submitBtn" class="btn btn-primary">Agregar</button>
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
