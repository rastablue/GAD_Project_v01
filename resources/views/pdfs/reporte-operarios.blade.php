@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Reporte de operarios </b></h5>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Operarios</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary" style="font-size: 9">
            <th scope="col" width="90px"><div class="text-center font-weight-bold text-info">Cedula</th>
            <th scope="col" width="150px"><div class="text-center font-weight-bold text-info">Nombre</th>
            <th scope="col" width="80px"><div class="text-center font-weight-bold text-info">Telefono</th>
            <th scope="col" width="100px"><div class="text-center font-weight-bold text-info">Contrato</th>
            <th scope="col" width="80px"><div class="text-center font-weight-bold text-info">Licencia</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($operario as $operarios)
            <tr style="font-size: 8">
                <td><div class="text-center">{{ $operarios->cedula }}</td>
                <td><div class="text-center">{{ $operarios->name }} {{ $operarios->apellido_pater }}</td>
                <td><div class="text-center">{{ $operarios->tlf }}</td>
                <td><div class="text-center">{{ $operarios->tipo_contrato }}</td>
                <td><div class="text-center">{{ $operarios->tipo_licencia }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
