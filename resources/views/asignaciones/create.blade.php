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
                    <form method="POST" action="{{ route('asigna.storecode') }}">
                        @csrf

                        {{-- Codigo Tarea --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Requerimiento</label>
                                <div class="col-md-6">
                                    <input id="codigo_tarea" name="codigo_tarea" type="text" pattern="{9}" class="form-control" required autocomplete="Codigo" autofocus>
                                </div>
                            </div>

                        {{-- Codigo Maquinaria --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Maquinaria</label>
                                <div class="col-md-6">
                                    <input id="codigo_maquinaria" name="codigo_maquinaria" type="text" pattern="{9}" class="form-control" required autocomplete="Codigo" autofocus>
                                </div>
                            </div>

                        {{-- btn--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-link"></i>Asignar</button>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
