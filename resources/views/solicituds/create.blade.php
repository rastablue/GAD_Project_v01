@extends('layouts.app')

@section('content')
@php
    $date = date("yy-m-d");
@endphp
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

                                {{-- cedula --}}
                                    <div class="form-group row">
                                        <label for="cedula" class="col-md-4 col-form-label text-md-right">Cedula del solicitante</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('cedula') is-invalid @enderror" value="{{ $cedula ?? old('cedula') }}" name="cedula" id="cedula" onkeyup="validar(this);" autofocus>
                                            <b><span id="salida" class="text-danger"></span></b>
                                            
                                            @error('cedula')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                
                                {{-- Fecha Inicio --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Inicio</label>
                                        <div class="col-md-6">
                                            <input type="date" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ $fecha_inicio ?? old('fecha_inicio') }}" autocomplete="Fecha inicio" autofocus>
                                        
                                            @error('fecha_inicio')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- Fecha Fin --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha del Fin</label>
                                        <div class="col-md-6">
                                            <input type="date" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" value="{{ $fecha_fin ?? old('fecha_fin') }}" autocomplete="Fecha fin" autofocus>
                                        
                                            @error('fecha_fin')
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
                                        <label for="observacion" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                        <div class="col-md-6">
                                            <textarea type="text" class="form-control @error('observacion') is-invalid @enderror" name="observacion" autofocus>{{ $observacion ?? old('observacion') }}</textarea>

                                            @error('observacion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                {{-- User ID --}}
                                    <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="card-footer">
                            <button type="submit" form="formSolicitud" id="submitBtn" class="btn btn-primary float-right">Agregar</button>
                            <a href="javascript:history.back()" class="btn btn-secondary float-right mr-2">Volver</a>
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

</script>
@endsection
