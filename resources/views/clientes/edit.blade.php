@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Actualizar Datos de: </b><i>{{ $cliente->name }} {{ $cliente->apellido_pater }}</i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                        @method('PUT')
                        @csrf

                        {{-- Cedula --}}
                            <div class="form-group row">
                                <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cedula') }}</label>

                                <div class="col-md-6">
                                    <input id="cedula" type="text" pattern="[0-9]{10}" placeholder="{{ $cliente->cedula }}" class="form-control @error('cedula') is-invalid @enderror" disabled name="cedula" value="{{ $cliente->cedula }}" required autocomplete="cedula" autofocus>

                                    @error('cedula')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Nombre --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" pattern="[A-Za-z]{1,25}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ $cliente->name }}" name="name" value="{{ $cliente->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Apellido Paterno --}}
                            <div class="form-group row">
                                <label for="apellido_pater" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

                                <div class="col-md-6">
                                    <input id="apellido_pater" type="text" pattern="[A-Za-z]{1,25}" class="form-control @error('apellido_pater') is-invalid @enderror" placeholder="{{ $cliente->apellido_pater }}" name="apellido_pater" value="{{ $cliente->apellido_pater }}" required autocomplete="apellido_pater" autofocus>

                                    @error('apellido_pater')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Apellido Materno --}}
                            <div class="form-group row">

                                <label for="apellido_mater" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

                                <div class="col-md-6">
                                    <input id="apellido_mater" type="text" pattern="[A-Za-z]{1,25}" class="form-control @error('apellido_mater') is-invalid @enderror" placeholder="{{ $cliente->apellido_mater }}" name="apellido_mater" value="{{ $cliente->apellido_mater }}" required autocomplete="apellido_mater" autofocus>

                                    @error('apellido_mater')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Direccion --}}
                            <div class="form-group row">
                                <label for="direc" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>

                                <div class="col-md-6">
                                    <input id="direc" type="text" class="form-control @error('direc') is-invalid @enderror" placeholder="{{ $cliente->direc }}" name="direc" value="{{ $cliente->direc }}" required autocomplete="direc" autofocus>

                                    @error('direc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Telefono --}}
                            <div class="form-group row">
                                <label for="tlf" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="tlf" type="text" pattern="[0-9]{7,10}" class="form-control @error('tlf') is-invalid @enderror" placeholder="{{ $cliente->tlf }}" name="tlf" value="{{ $cliente->tlf }}" required autocomplete="tlf" autofocus>

                                    @error('tlf')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Email --}}
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" placeholder="{{ $cliente->email }}" name="email" value="{{ $cliente->email }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
