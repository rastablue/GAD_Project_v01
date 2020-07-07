@extends('layouts.app')

@section('content')
<form id="formSolicitud" method="POST" action="{{ route('clientes.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Formulario Mantenimiento -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                        <a href="" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Agregar Cliente</h6>
                        </a>
                    <!-- Card Content - Collapse -->
                        <div class="collapse show">
                            <div class="card-body">

                                {{-- Cedula --}}
                                    <div class="form-group row">
                                        <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cedula') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" id="cedula" name="cedula" value="{{ old('cedula') }}" class="form-control @error('cedula') is-invalid @enderror" autocomplete="cedula" onkeyup="validar(this);" autofocus>
                                            <b><span id="salida" class="text-danger"></span></b>

                                            @error('cedula')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Nombre --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="nombre" value="{{ old('nombre') }}" onkeyup="mayus(this);" class="form-control @error('nombre') is-invalid @enderror" autocomplete="nombre" autofocus>

                                            @error('nombre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Apellido Paterno --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="apellido_paterno" value="{{ old('apellido_paterno') }}" onkeyup="mayus(this);" class="form-control @error('apellido_paterno') is-invalid @enderror" autocomplete="apellido_paterno" autofocus>

                                            @error('apellido_paterno')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Apellido Materno --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="apellido_materno" value="{{ old('apellido_materno') }}" onkeyup="mayus(this);" class="form-control @error('apellido_materno') is-invalid @enderror" autocomplete="apellido_materno" autofocus>

                                            @error('apellido_materno')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Direccion --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="direccion" value="{{ old('direccion') }}" class="form-control @error('direccion') is-invalid @enderror" autocomplete="direccion" autofocus>

                                            @error('direccion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Telefono --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="telefono" value="{{ old('telefono') }}" class="form-control @error('telefono') is-invalid @enderror" autocomplete="telefono" autofocus>

                                            @error('telefono')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Email --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- btn--}}
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-6">
                                            <button type="submit" id="submitBtn" class="btn btn-primary">Agregar</button>
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

    function validar() {
        var cad = document.getElementById("cedula").value.trim();
        var total = 0;
        var longitud = cad.length;
        var longcheck = longitud - 1;

        if (cad !== "" && longitud === 10){
            for(i = 0; i < longcheck; i++){
                if (i%2 === 0) {
                    var aux = cad.charAt(i) * 2;
                    if (aux > 9) aux -= 9;
                    total += aux;
                } else {
                    total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
                }
            }

            total = total % 10 ? 10 - total % 10 : 0;

            if (cad.charAt(longitud-1) == total) {
                document.getElementById("salida").innerHTML = ("Cedula Válida");

                $(function() {
                    $(document).ready(function(){
                        $('#submitBtn').show()
                    });
                });

            }else{
                document.getElementById("salida").innerHTML = ("Cedula Inválida");

                $(function() {
                    $(document).ready(function(){
                        $('#submitBtn').hide()
                    });
                });

            }
        }
    }

    $('#file-upload').bind('change', function() { var fileName = ''; fileName = $(this).val(); $('#file-selected').html(fileName); })
</script>
@endsection
