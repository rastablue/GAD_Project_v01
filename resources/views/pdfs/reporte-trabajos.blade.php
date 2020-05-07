@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Reporte de trabajos </b></h5>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Trabajos</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary" style="font-size: 9">
            <th scope="col" width="50px"><div class="text-center font-weight-bold text-info">Codigo</th>
            <th scope="col" width="70px"><div class="text-center font-weight-bold text-info">Mantenimiento</th>
            <th scope="col" width="140px"><div class="text-center font-weight-bold text-info">Mano De Obra</th>
            <th scope="col" width="140px"><div class="text-center font-weight-bold text-info">Repuestos</th>
            <th scope="col" width="60px"><div class="text-center font-weight-bold text-info">Estado</th>
            <th scope="col" width="60px"><div class="text-center font-weight-bold text-info">Tipo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($trabajo as $trabajos)
            <tr style="font-size: 8">
                <td><div class="text-center">{{ $trabajos->fake_id }}</td>
                <td><div class="text-center">{{ $trabajos->mantenimientos->codigo }}</td>
                <td><div class="text-center">{{ $trabajos->manobra }}</td>
                <td><div class="text-center">{{ $trabajos->repuestos }}</td>
                <td><div class="text-center">{{ $trabajos->estado }}</td>
                <td><div class="text-center">{{ $trabajos->tipo }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
