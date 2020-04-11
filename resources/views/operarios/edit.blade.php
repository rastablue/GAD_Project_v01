@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Actualizar Datos de: </b><i>{{ $operario->name }} {{ $operario->apellido_pater }}</i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('operarios.update', $operario->id) }}">
                        @method('PUT')
                        @csrf

                        {{-- Cedula --}}
                            <div class="form-group row">
                                <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cedula') }}</label>

                                <div class="col-md-6">
                                    <input id="cedula" type="text" pattern="[0-9]{10}" placeholder="{{ $operario->cedula }}" class="form-control" disabled name="cedula" value="{{ $operario->cedula }}" required autocomplete="cedula" autofocus>
                                </div>
                            </div>

                        {{-- Nombre --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" placeholder="{{ $operario->name }}" pattern="[A-Za-z]{1,25}" class="form-control" name="name" value="{{ $operario->name }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                        {{-- Apellido Paterno --}}
                            <div class="form-group row">
                                <label for="apellido_pater" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

                                <div class="col-md-6">
                                    <input id="apellido_pater" type="text" placeholder="{{ $operario->apellido_pater }}" pattern="[A-Za-z]{1,25}" class="form-control" name="apellido_pater" value="{{ $operario->apellido_pater }}" required autocomplete="apellido_pater" autofocus>
                                </div>
                            </div>

                        {{-- Apellido Materno --}}
                            <div class="form-group row">
                                <label for="apellido_mater" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

                                <div class="col-md-6">
                                    <input id="apellido_mater" type="text" placeholder="{{ $operario->apellido_mater }}" pattern="[A-Za-z]{1,25}" class="form-control" name="apellido_mater" value="{{ $operario->apellido_mater }}" required autocomplete="apellido_mater" autofocus>
                                </div>
                            </div>

                        {{-- Direccion --}}
                            <div class="form-group row">
                                <label for="direc" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>

                                <div class="col-md-6">
                                    <input id="direc" type="text" placeholder="{{ $operario->direc }}" class="form-control" name="direc" value="{{ $operario->direc }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                        {{-- Telefono --}}
                            <div class="form-group row">
                                <label for="tlf" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="tlf" type="text" pattern="[0-9]{7,10}" placeholder="{{ $operario->tlf }}" class="form-control" name="tlf" value="{{ $operario->tlf }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                        {{-- Tipo Contrato --}}
                            <div class="form-group row">
                                <label for="tipo_contrato" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Contrato') }}</label>

                                <div class="col-md-6">

                                    <select id="tipo_contrato" class="form-control" name="tipo_contrato">
                                        <option disabled>Seleccione un Contrato</option>
                                        <option selected='true'>{{ $operario->tipo_contrato }}</option>
                                        @foreach(App\Operario::getEnumValues('operarios', 'tipo_contrato') as $operarios)
                                            <option value="{{ $operarios }}">  {{ $operarios}}  </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                        {{-- Tipo Licencia --}}
                            <div class="form-group row">
                                <label for="tipo_licencia" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Licencia') }}</label>

                                <div class="col-md-6">

                                    <select id="tipo_licencia" class="form-control" name="tipo_licencia">
                                        <option disabled>Seleccione una Licencia</option>
                                        <option selected='true'>{{ $operario->tipo_licencia }}</option>
                                        @foreach(App\Operario::getEnumValues('operarios', 'tipo_licencia') as $operarios)
                                            <option value="{{ $operarios }}">  {{ $operarios}}  </option>
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
