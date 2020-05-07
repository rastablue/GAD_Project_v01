@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Reporte de clientes </b></h5>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Clientes</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary" style="font-size: 9">
            <th scope="col" width="60px"><div class="text-center font-weight-bold text-info">Cedula</th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Nombre</th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Telefono</th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Direccion</th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cliente as $clientes)
            <tr style="font-size: 8">
                <td><div class="text-center">{{ $clientes->cedula }}</td>
                <td><div class="text-center">{{ $clientes->name }} {{ $clientes->apellido_pater }}</td>
                <td><div class="text-center">{{ $clientes->tlf }}</td>
                <td><div class="text-center">{{ $clientes->direc }}</td>
                <td><div class="text-center">{{ $clientes->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
