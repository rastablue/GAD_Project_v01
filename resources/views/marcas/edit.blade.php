@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Actualizar Marca: </b><i>{{ $marca->marca }}</i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('marcas.update', $marca->id) }}">
                        @method('PUT')
                        @csrf

                        {{-- Marca --}}
                            <div class="form-group row">
                                <label for="cedula" class="col-md-4 col-form-label text-md-right">Marca</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="{{ $marca->marca }}" class="form-control" name="marca" value="{{ $marca->marca }}" required autocomplete="marca" autofocus>
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
