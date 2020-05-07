@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Reporte de solicitudes </b></h5>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Solicitudes</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary" style="font-size: 9">
            <th scope="col" width="50px"><div class="text-center font-weight-bold text-info">Codigo</th>
            <th scope="col" width="120px"><div class="text-center font-weight-bold text-info">Fecha Emision</th>
            <th scope="col" width="110px"><div class="text-center font-weight-bold text-info">Responsable</th>
            <th scope="col" width="110px"><div class="text-center font-weight-bold text-info">Solicitante</th>
            <th scope="col" width="90px"><div class="text-center font-weight-bold text-info">Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($solicitud as $solicitudes)
            <tr style="font-size: 8">
                <td><div class="text-center">{{ $solicitudes->codigo_solicitud }}</td>
                <td><div class="text-center">{{ $solicitudes->fecha_emision }}</td>
                <td><div class="text-center">{{ $solicitudes->users->name }} {{ $solicitudes->users->apellido_pater }}</td>
                <td><div class="text-center">{{ $solicitudes->clientes->name }} {{ $solicitudes->clientes->apellido_pater }}</td>
                <td><div class="text-center">{{ $solicitudes->estado }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
