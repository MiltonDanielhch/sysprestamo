<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato</title>
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table th {
            background-color: #e7e7e7;
        }
    </style>
</head>
<body>
<table border="0" style="font-size: 9pt">
    <tr style="text-align: center;">
        <td>
            {{ $configuracion->nombre }} <br>
            {{ $configuracion->descripcion }} <br>
            {{ $configuracion->direccion }} <br>
            {{ $configuracion->telefono }} <br>
            {{ $configuracion->email }} <br>
        </td>
        <td width="400px"></td>
        <td style="text-align: center;"><img src="{{ public_path('storege/'.$configuracion->logo) }}" width="80px" alt=""></td>
    </tr>
</table>
<p style="text-align:center"><b style="font-size: 25pt"><u>Prestamo Nro {{ $prestamo->id }}</u></b></p>
<br>
<b>Datos del Cliente: </b>
<hr>
<table class="table table-bordered" cellpadding="3">
    <tr>
        <td style="background-color: #c0c0c0"><b>Documento:</b></td>
        <td>{{ $prestamo->cliente->nro_documento }}</td>
        <td style="background-color: #c0c0c0"><b>Correo Electronico:</b></td>
        <td>{{ $prestamo->cliente->email }}</td>
    </tr>
    <tr>
        <td style="background-color: #c0c0c0"><b>Cliente:</b></td>
        <td>{{ $prestamo->cliente->apellidos." ".$prestamo->cliente->nombres }}</td>
        <td style="background-color: #c0c0c0"><b>Celular:</b></td>
        <td>{{ $prestamo->cliente->celular }}</td>
    </tr>
    <tr>
        <td style="background-color: #c0c0c0"><b>Fecha de Nacimiento: </b></td>
        <td>{{ $prestamo->cliente->fecha_nacimiento }}</td>
        <td style="background-color: #c0c0c0"><b>Ref de Celular: </b></td>
        <td>{{ $prestamo->cliente->ref_celular }}</td>
    </tr>
    <tr>
        <td style="background-color: #c0c0c0"><b>Género: </b> </td>
        <td>{{ $prestamo->cliente->genero }}</td>
    </tr>
</table>
<br>
<b>Detalle del Prestamo</b>
<hr>

<table class="table table-bordered" cellpadding="3">
    <tr>
        <td style="background-color: #c0c0c0"><b>Monto del Prestamo:</b></td>
        <td>{{ $configuracion->moneda." ". $prestamo->monto_prestado }}</td>
        <td style="background-color: #c0c0c0"><b>Tasa de Interes:</b></td>
        <td>{{ $prestamo->tasa_interes }}</td>
    </tr>
    <tr>
        <td style="background-color: #c0c0c0"><b>Modalidad de Pago:</b></td>
        <td>{{ $prestamo->modalidad }}</td>
        <td style="background-color: #c0c0c0"><b>Nro de Cuotas:</b></td>
        <td>{{ $prestamo->nro_cuotas }}</td>
    </tr>
    <tr>
        <td style="background-color: #c0c0c0"><b>Monto Total: </b></td>
        <td>{{ $configuracion->moneda." ". $prestamo->monto_total }}</td>
        <td style="background-color: #c0c0c0"><b>Estado: </b></td>
        <td>{{ $prestamo->estado }}</td>
    </tr>
</table>
<br>
<b>Detalle del Prestamo</b>
<hr>
<table border="0" class="table table-bordered" cellpadding="3">
    <thead>
        <tr style="background-color:#c0c0c0">
            <th>Nro de Cuotas</th>
            <th>Fecha de Pago</th>
            <th>Monto</th>
            <th>Estado</th>
        </tr>
    </thead>
    @php
        $contador=1;
    @endphp
    @foreach($pagos as $pago)
        <tr>
            <td>{{$contador++}}</td>
            <td>{{$pago->fecha_pago}}</td>
            <td>{{$configuracion->modena." ".$pago->monto_pagado}}</td>
            <td>{{$pago->estado}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
