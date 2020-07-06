@extends('layouts.pdf')

@section('content')
@endsection


<!doctype html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Aloha!</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
    </style>

    </head>
    <body>

        <table width="100%">
            <tr>
                <td valign="top"><img src="{{asset('images/gad.jpg')}}" alt="" width="250"/></td>
                <td align="right">
                    <h2>GAD MUNICIPAL LAS NAVES</h2>
                    <pre>
                        Emitido a nombre de:<br>
                        <b>{{ $solicitud->clientes->name }} {{ $solicitud->clientes->apellido_pater }} {{ $solicitud->clientes->apellido_mater }}</b>
                        Fecha de emision:<br>
                        <b>{{ Carbon\Carbon::now() }}</b>
                        Codigo solicitud:<br>
                        <b>{{ $solicitud->codigo_solicitud }}</b>
                    </pre>
                </td>
            </tr>
        </table>

        <table width="100%">
            <thead style="background-color: lightgray;">
            <tr>
                <th>Responsable</th>
                <th>Detalle</th>
                <th>Observacion</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $solicitud->users->name }} {{ $solicitud->users->apellido_pater }}</td>
                <td>{{ $solicitud->detalle }}</td>
                <td>{{ $solicitud->observacion }}</td>
            </tr>
            </tbody>
        </table>

        <br><hr><br>

        @if(@$solicitud->tareas->first())
            <h3>Requerimientos de la solicitud</h3>
        @endif

        @if(@$solicitud->tareas->first())
            <table width="100%">
                <thead style="background-color: lightgray;">
                <tr>
                    <th>N°</th>
                    <th>Direccion</th>
                    <th>Detalle</th>
                </tr>
                </thead>
                @foreach (@$solicitud->tareas as $item)
                    <tbody class="mt-3">
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->direc_tarea }}</td>
                            <td>{{ $item->detalle }}</td>
                        </tr>
                        
                    </tbody>
                @endforeach
            </table>
        @endif
        <br><hr><br><br><br>

        <pre>
            <em> <br>Para mas informacion acerca de esta solicitud consulte la pagina web. </em>
            <em> <br>La solicitud puede tener un periodo de 10 dias luego de su emision para recibir una respuesta sobre su aprobacion<br> o rechazo. </em>
        </pre>
    </body>
</html>