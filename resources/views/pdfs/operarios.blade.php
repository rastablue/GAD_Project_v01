@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Operario: </b></h5>{{ $operario->name }} {{ $operario->apellido_pater }} <br><br>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Operario</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary">
                <th scope="col" width="90px"><div class="text-center font-weight-bold text-info">Cedula</th>
                <th scope="col" width="150px"><div class="text-center font-weight-bold text-info">Nombre</th>
                <th scope="col" width="80px"><div class="text-center font-weight-bold text-info">Telefono</th>
                <th scope="col" width="100px"><div class="text-center font-weight-bold text-info">Contrato</th>
                <th scope="col" width="80px"><div class="text-center font-weight-bold text-info">Licencia</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div class="text-center">{{ $operario->cedula }}</td>
            <td><div class="text-center">{{ $operario->name }} {{ $operario->apellido_pater }}</td>
            <td><div class="text-center">{{ $operario->tlf }}</td>
            <td><div class="text-center">{{ $operario->tipo_contrato }}</td>
            <td><div class="text-center">{{ $operario->tipo_licencia }}</td>
        </tr>
    </tbody>
</table>

<hr class="sidebar-divider">

@if(@$operario->maquinarias->first())
    <h4 class="font-weight-bold text-success"><b> Maquinarias </b></h4>
    <table class="table">
        <tbody>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">N°</th>
                    @foreach (@$operario->maquinarias as $item)
                        <td>{{ $loop->iteration }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Codigo</th>
                    @foreach (@$operario->maquinarias as $item)
                        <td>{{ $item->codigo_nro_gad }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Placa</th>
                    @foreach (@$operario->maquinarias as $item)
                        <td>{{ $item->placa }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Marca</th>
                    @foreach (@$operario->maquinarias as $item)
                        <td>{{ $item->marcas->marca }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Modelo</th>
                    @foreach (@$operario->maquinarias as $item)
                        <td>{{ $item->modelo }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Año</th>
                    @foreach (@$operario->maquinarias as $item)
                        <td>{{ $item->anio }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Observacion</th>
                    @foreach (@$operario->maquinarias as $item)
                        <td>{{ $item->observacion }}</td>
                    @endforeach
            </tr>
        </tbody>
    </table>
@endif
@endsection
