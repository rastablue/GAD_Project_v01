@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-tareas-center">
                    <span><h4><b>Asignar Maquinarias </b></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <!--La ruta acontinuacion se encuentra en la ruta de las maquinarias-->
                    <form method="POST" action="{{ route('asigna.storecode') }}">
                        @csrf

                        {{-- Codigo Tarea --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Requerimientos</label>
                                <div class="col-md-5">
                                    <select id="tarea" class="form-control" name="tarea">
                                        <option disabled selected='true'>Seleccione un Requerimiento</option>
                                        @foreach(@App\Tarea::all() as $item)
                                            @if (@$item->estado != 'Finalizada' && @$item->estado != 'Abandonado' && @$item->estado != 'Pendiente')
                                                <option value="{{ $item->id }}">{{ $item->fake_id }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        {{-- Codigo Maquinaria --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Maquinarias</label>
                                <div class="col-md-5">
                                    <select id="maquinaria" class="form-control" name="maquinaria">
                                        <option disabled selected='true'>Seleccione una Maquinaria</option>
                                        @foreach(@App\maquinaria::all() as $item)
                                            @if (@$item->mantenimientos->first()->estado == "Finalizado" || @$item->mantenimientos->first()->estado == Null)
                                                <option value="{{ $item->id }}">  {{ $item->codigo_nro_gad }} <br> {{ $item->placa }}  </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        {{-- btn--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-fw fa-link"></i>
                                        Asignar
                                    </button>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
