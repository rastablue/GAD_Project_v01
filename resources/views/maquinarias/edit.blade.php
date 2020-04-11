@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-tareas-center">
                    <span><h4><b>Actualizar vehiculo: </b><i>{{ $maquinaria->placa }}</i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('maquinarias.update', $maquinaria->id) }}">
                        @method('PUT')
                        @csrf

                        {{-- Codigo GAD --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo GAD</label>
                                <div class="col-md-6">
                                    <input type="input" disabled id="codigo" name="codigo" value="{{$maquinaria->codigo_nro_gad}}" placeholder="{{$maquinaria->codigo_nro_gad}}" class="form-control" required autocomplete="codigo" autofocus>
                                </div>
                            </div>

                        {{-- Placa --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Placa</label>
                                <div class="col-md-6">
                                    <input type="input" disabled id="placa" name="placa" value="{{$maquinaria->placa}}" placeholder="{{$maquinaria->placa}}" class="form-control" required autocomplete="placa" autofocus>
                                </div>
                            </div>

                        {{-- Marca --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Marca</label>
                                <div class="col-md-6">
                                    <select id="marca" class="form-control" name="marca">
                                        <option value="{{ $maquinaria->marcas->id }}" selected='true'>{{$maquinaria->marcas->marca }}</option>
                                        @foreach(App\Marca::all() as $marcas)
                                            <option value="{{ $marcas->id }}">  {{ $marcas->marca }}  </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        {{-- Modelo --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Modelo</label>
                                <div class="col-md-6">
                                    <input type="input" id="modelo" name="modelo" value="{{$maquinaria->modelo}}" placeholder="{{$maquinaria->modelo}}" class="form-control" required autocomplete="modelo" autofocus>
                                </div>
                            </div>

                        {{-- Año --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Año</label>
                                <div class="col-md-6">
                                    <input type="input" id="anio" name="anio" value="{{$maquinaria->anio}}" placeholder="{{$maquinaria->anio}}" class="form-control" required autocomplete="anio" autofocus>
                                </div>
                            </div>

                        {{-- Kilometraje --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Kilometraje</label>
                                <div class="col-md-6">
                                    <input type="number" name="kilometraje" value="{{ $maquinaria->kilometraje }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                </div>
                            </div>

                        {{-- Tipo --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Tipo</label>
                                <div class="col-md-6">
                                    <input type="input" id="tipo" name="tipo" value="{{$maquinaria->tipo_vehiculo}}" placeholder="{{$maquinaria->tipo_vehiculo}}" class="form-control" required autocomplete="tipo" autofocus>
                                </div>
                            </div>

                        {{-- Observacion --}}
                            <div class="form-group row">
                                <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                <div class="col-md-6">
                                    <textarea type="text" id="observacion" name="observacion" class="form-control" autocomplete="observacion" autofocus>{{$maquinaria->observacion}}</textarea>
                                </div>
                            </div>

                        {{-- btn--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
