@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Reporte de tareas </b></h5>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Tareas</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col" width="80px"><div class="text-center font-weight-bold text-info">Codigo</th>
            <th scope="col" width="80px"><div class="text-center font-weight-bold text-info">Solicitud</th>
            <th scope="col" width="120px"><div class="text-center font-weight-bold text-info">Fecha Inicio</th>
            <th scope="col" width="110px"><div class="text-center font-weight-bold text-info">Direccion</th>
            <th scope="col" width="90px"><div class="text-center font-weight-bold text-info">Estado</th>
            <th scope="col" width="110px"><div class="text-center font-weight-bold text-info">Detalle</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tarea as $tareas)
            <tr>
                <td><div class="text-center">{{ $tareas->fake_id }}</td>
                <td><div class="text-center">{{ $tareas->solicituds->codigo_solicitud }}</td>
                <td><div class="text-center">{{ $tareas->fecha_inicio }}</td>
                <td><div class="text-center">{{ $tareas->direc_tarea }}</td>
                <td><div class="text-center">{{ $tareas->estado }}</td>
                <td><div class="text-center">{{ $tareas->detalle }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
