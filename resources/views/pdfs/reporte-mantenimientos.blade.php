@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Reporte de mantenimientos </b></h5>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Mantenimientos</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col" width="60px"><div class="text-center font-weight-bold text-info">Codigo</th>
            <th scope="col" width="120px"><div class="text-center font-weight-bold text-info">Fecha de Ingreso</th>
            <th scope="col" width="70px"><div class="text-center font-weight-bold text-info">Monto Total</th>
            <th scope="col" width="70px"><div class="text-center font-weight-bold text-info">Estado</th>
            <th scope="col" width="140px"><div class="text-center font-weight-bold text-info">Diagnostico</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mantenimiento as $mantenimientos)
            <tr>
                <td><div class="text-center">{{ $mantenimientos->codigo }}</td>
                <td><div class="text-center">{{ $mantenimientos->fecha_ingreso }}</td>
                <td><div class="text-center">{{ $mantenimientos->valor_total }}</td>
                <td><div class="text-center">{{ $mantenimientos->estado }}</td>
                <td><div class="text-center">{{ $mantenimientos->diagnostico }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
