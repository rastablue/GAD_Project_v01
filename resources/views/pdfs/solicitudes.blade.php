@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Solicitud emitida a nombre de: </b></h5>{{ $solicitud->clientes->name }} {{ $solicitud->clientes->apellido_pater }} {{ $solicitud->clientes->apellido_mater }} <br><br>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Solicitud</b></h4>
<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col" width="80px"><div class="text-center font-weight-bold text-info">Codigo</th>
            <th scope="col" width="130px"><div class="text-center font-weight-bold text-info">Fecha de Emision</th>
            <th scope="col" width="130px"><div class="text-center font-weight-bold text-info">Fecha de Revision</th>
            <th scope="col" width="120px"><div class="text-center font-weight-bold text-info">Responsable</th>
            <th scope="col" width="75px"><div class="text-center font-weight-bold text-info">Estado</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div class="text-center">{{ $solicitud->codigo_solicitud }}</td>
            <td><div class="text-center">{{ $solicitud->fecha_emision }}</td>
            <td><div class="text-center">{{ $solicitud->fecha_revision }}</td>
            <td><div class="text-center">{{ $solicitud->users->name }} {{ $solicitud->users->apellido_pater }}</td>
            <td><div class="text-center">{{ $solicitud->estado }}</td>
        </tr>
        <tr>
            <th scope="col"><div class="text-center font-weight-bold text-info">Detalles:</th>
            <td scope="col" colspan="4"> {{ $solicitud->detalle }} <br><br></td>
        </tr>
    </tbody>
</table>

<hr class="sidebar-divider">
@if(@$solicitud->tareas->first())
    <h4 class="font-weight-bold text-success"><b> Tareas </b></h4>
    <table class="table">
        <tbody>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">N°</th>
                    @foreach (@$solicitud->tareas as $item)
                        <td>{{ $loop->iteration }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Codigo</th>
                    @foreach (@$solicitud->tareas as $item)
                        <td>{{ $item->fake_id }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Fecha de Inicio</th>
                    @foreach (@$solicitud->tareas as $item)
                        <td>{{ $item->fecha_inicio }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Fecha de Fin</th>
                    @foreach (@$solicitud->tareas as $item)
                        <td>{{ $item->fecha_fin }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Direccion</th>
                    @foreach (@$solicitud->tareas as $item)
                        <td>{{ $item->direc_tarea }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Estado</th>
                    @foreach (@$solicitud->tareas as $item)
                        <td>{{ $item->estado }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Detalles</th>
                    @foreach (@$solicitud->tareas as $item)
                        <td>{{ $item->detalle }}</td>
                    @endforeach
            </tr>
        </tbody>
    </table>
@endif
@endsection
