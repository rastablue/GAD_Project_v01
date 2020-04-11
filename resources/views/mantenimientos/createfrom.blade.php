@extends('layouts.app')

@section('content')
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
                    <form method="POST" action="{{ route('mantenimientos.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Ficha --}}
                            <div class="form-group row">
                                <label for="ficha" class="col-md-3 text-md-right">Numero de Ficha</label>
                                <div class="col-md-8">
                                    <input id="ficha" type="text" pattern="[0-9]{7}" class="form-control" name="ficha" required autocomplete="ficha" autofocus>
                                </div>
                            </div>

                        {{-- Placa del vehiculo --}}
                            <input id="placa" type="hidden" name="placa" value="{{ $vehiculo->placa }}">

                        {{-- Placa del Vehiculo --}}
                            <div class="form-group row">

                                <label for="placa" class="col-md-3 text-md-right">Placa del Vehiculo</label>

                                <div class="col-md-8">
                                <input type="text" class="form-control" disabled value="{{ $vehiculo->placa }}" required autocomplete="placa" autofocus>
                                </div>
                            </div>

                        {{-- Observacion --}}
                            <div class="form-group row">
                                <label for="observacion" class="col-md-3 text-md-right">Observacion</label>
                                <div class="col-md-8">
                                    <textarea id="observacion" type="text" class="form-control" name="observacion" required autocomplete="observacion" autofocus></textarea>
                                </div>
                            </div>

                        {{-- Diagnostico --}}
                            <div class="form-group row">
                                <label for="diagnostico" class="col-md-3 text-md-right">Diagnostico</label>

                                <div class="col-md-8">
                                    <textarea id="diagnostico" type="text" class="form-control" name="diagnostico" required autocomplete="diagnostico" autofocus></textarea>
                                </div>
                            </div>

                        {{-- Imagen de la Ficha --}}
                            <div class="form-group row">
                                <label for="file" class="col-md-3 text-md-right">Cargar Imagen de la Ficha</label>
                                <div class="col-md-8">
                                    <input id="file" type="file" name="file">
                                </div>
                            </div>

                        {{-- btn--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
