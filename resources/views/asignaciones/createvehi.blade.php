@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-tareas-center">
                    <span><h4><b>Asignar vehiculos </b></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('asignavehi.storecode') }}">
                        @csrf

                        {{-- Operario --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Operarios</label>
                                <div class="col-md-5">
                                    <select id="operario" class="form-control" name="operario">
                                        <option disabled selected='true'>Seleccione un Operario</option>
                                        @foreach(@App\Operario::all() as $item)
                                            <option value="{{ $item->id }}">  {{ $item->cedula }} -|- {{ $item->name }} {{ $item->apellido_pater }}  </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        {{-- Maquinaria --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Maquinarias</label>
                                <div class="col-md-5">
                                    <select id="maquinaria" class="form-control" name="maquinaria">
                                        <option disabled selected='true'>Seleccione una Maquinaria</option>
                                        @foreach(@App\maquinaria::all() as $item)
                                            <option value="{{ $item->id }}">  {{ $item->codigo_nro_gad }} -|- {{ $item->placa }}  </option>
                                        @endforeach
                                    </select>
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
