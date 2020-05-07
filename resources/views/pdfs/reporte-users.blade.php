@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Reporte de funcionarios </b></h5>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Funcionarios</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary" style="font-size: 9">
            <th scope="col" width="60px"><div class="text-center font-weight-bold text-info">Cedula</th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Nombre</th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Telefono</th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $users)
            <tr style="font-size: 8">
                <td><div class="text-center">{{ $users->cedula }}</td>
                <td><div class="text-center">{{ $users->name }} {{ $users->apellido_pater }}</td>
                <td><div class="text-center">{{ $users->tlf }}</td>
                <td><div class="text-center">{{ $users->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
