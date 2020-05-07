@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Reporte de vehiculos </b></h5>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Vehiculos</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary" style="font-size: 9">
            <th scope="col" width="60px"><div class="text-center font-weight-bold text-info">Codigo</th>
            <th scope="col" width="70px"><div class="text-center font-weight-bold text-info">Placa</th>
            <th scope="col" width="70px"><div class="text-center font-weight-bold text-info">Tipo</th>
            <th scope="col" width="90px"><div class="text-center font-weight-bold text-info">Marca / Modelo</th>
            <th scope="col" width="100px"><div class="text-center font-weight-bold text-info">Conductor a cargo</th>
            <th scope="col" width="100px"><div class="text-center font-weight-bold text-info">Observacion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($maquinaria as $maquinarias)
            <tr style="font-size: 8">
                <td><div class="text-center">{{ $maquinarias->codigo_nro_gad }}</td>
                <td><div class="text-center">{{ $maquinarias->placa }}</td>
                <td><div class="text-center">{{ $maquinarias->tipo_vehiculo }}</td>
                <td><div class="text-center">{{ $maquinarias->marcas->marca }} / {{ $maquinarias->modelo }} - {{ $maquinarias->anio }}</td>
                <td><div class="text-center">{{ $maquinarias->operarios->name }} {{ $maquinarias->operarios->apellido_pater }}</td>
                <td><div class="text-center">{{ $maquinarias->observacion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
