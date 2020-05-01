@extends('layouts.app')

@section('content')

<form id="formAgregarCliente" method="POST" action="{{ route('solicituds.clientestore') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Formulario Cliente -->
                <div class="card shadow mb-4">

                    <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Datos del Solicitante</h6>
                        </a>

                    <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">
                                <div class="text-center">
                                    <em>Ingrese los datos del solicitante<br><br></em>
                                </div>

                                {{-- Funcionario --}}
                                    <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                {{-- cedula --}}
                                    <div class="form-group row">
                                        <label for="cedula" class="col-md-4 col-form-label text-md-right">Cedula</label>
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

                                {{-- Nombre --}}
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                        <div class="col-md-6">
                                            <input type="text" onkeyup="mayus(this);" class="form-control @error('nombre') is-invalid @enderror" value="{{ $nombre ?? old('nombre') }}" name="nombre" autofocus>
                                       
                                            @error('nombre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Apellido Paterno --}}
                                    <div class="form-group row">
                                        <label for="apellido_pater" class="col-md-4 col-form-label text-md-right">Apellido Paterno</label>
                                        <div class="col-md-6">
                                            <input type="text" onkeyup="mayus(this);" class="form-control @error('apellido_paterno') is-invalid @enderror" value="{{ $apellido_paterno ?? old('apellido_paterno') }}" name="apellido_paterno" autofocus>
                                        
                                            @error('apellido_paterno')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Apellido Materno --}}
                                    <div class="form-group row">

                                        <label for="apellido_materno" class="col-md-4 col-form-label text-md-right">Apellido Materno</label>
                                        <div class="col-md-6">
                                            <input type="text" onkeyup="mayus(this);" class="form-control @error('apellido_materno') is-invalid @enderror" value="{{ $apellido_materno ?? old('apellido_materno') }}" name="apellido_materno" autofocus>
                                        
                                            @error('apellido_materno')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Direccion --}}
                                    <div class="form-group row">
                                        <label for="direc" class="col-md-4 col-form-label text-md-right">Direccion</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('direccion') is-invalid @enderror" value="{{ $direccion ?? old('direccion') }}" name="direccion" autofocus>
                                        
                                            @error('direccion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Telefono --}}
                                    <div class="form-group row">
                                        <label for="tlf" class="col-md-4 col-form-label text-md-right">Telefono</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" value="{{ $telefono ?? old('telefono') }}" name="telefono" autofocus>
                                        
                                            @error('telefono')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Email --}}
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" name="email" autofocus>
                                        
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
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
                                {{-- Codigo --}}
                                    <div class="row">
                                        <div class="form-group row">
                                            <label for="codigo" class="col-md-3 col-form-label text-md-right">Codigo</label>
                                            <div class="col-md-2">
                                                <input id="codigo1" disabled onkeyup="mayus(this);" type="text" class="form-control" name="codigo1" value="{{ $request->codigo1 ?? old('codigo1') }}" autocomplete="Codigo" autofocus>
                                                
                                                <input type="hidden" name="codigo1" value="{{ $request->codigo1 }}">
                                            </div>

                                            <label for="codigo" class="col-form-label">-</label>
                                            <div class="col-md-2">
                                                <input id="codigo2" disabled onkeyup="mayus(this);" type="text" class="form-control" name="codigo2" value="{{ $request->codigo2 ?? old('codigo2') }}" autocomplete="Codigo" autofocus>

                                                <input type="hidden" name="codigo2" value="{{ $request->codigo2 }}">
                                            </div>

                                            <label for="codigo" class="col-form-label">-</label>
                                            <div class="col-md-2">
                                                <input id="codigo3" disabled onkeyup="mayus(this);" type="text" class="form-control" name="codigo3" value="{{ $request->codigo3 ?? old('codigo3') }}" autocomplete="Codigo" autofocus>

                                                <input type="hidden" name="codigo3" value="{{ $request->codigo3 }}">
                                            </div>
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

            <!-- Modal footer -->
                <div class="modal-footer">
                    <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                    <button type="submit" form="formAgregarCliente" id="submitBtn" class="btn btn-primary">Agregar</button>
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
