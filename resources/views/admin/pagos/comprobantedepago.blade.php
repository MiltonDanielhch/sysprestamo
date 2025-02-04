<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante de Pagos</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 10px; /* Reducido */
            font-size: 9pt; /* Reducido */
            line-height: 1.2; /* Compactado */
        }
        .table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 5px; /* Reducido */
            page-break-inside: avoid;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 4px; /* Reducido */
            text-align: left;
        }
        .table tr:nth-child(even) { background-color: #f9f9f9; }
        .table th { background-color: #e0e0e0; }
        .header td { vertical-align: top; }
        u { text-decoration-thickness: 1px; }
        hr { margin: 5px 0; } /* Reducido */
        h1, h3 { margin: 10px 0; font-size: 11pt; } /* Títulos más pequeños */
        .footer {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 7pt; /* Más pequeño */
        }
        img { max-width: 80px; height: auto; } /* Logo más pequeño */
    </style>
</head>
<body>
<!-- Encabezado -->
<table class="table" border="0">
    <tr class="header">
        <td style="text-align: center; width: 50%">
            <img src="{{ public_path('storage/'.$configuracion->logo) }}" alt="Logo"> <br>
            <strong>{{ $configuracion->nombre }}</strong><br>
            {{ $configuracion->descripcion }}<br>
            {{ $configuracion->direccion }}<br>
            Teléfono: {{ $configuracion->telefono }}<br>
            Email: {{ $configuracion->email }}
        </td>
        <td width="300px"></td>
        <td style="text-align: center">
            <b>Nro de Pago: </b> {{ $pago->id }} <br>
            <h3>ORIGINAL</h3>
        </td>
    </tr>
</table>
<p style="text-align:center"><b style="font-size: 18pt"><u>COMPROBANTE DE PAGO</u></b></p>
<br>
<b>Datos del Cliente:</b>
<hr>

<table class="table" cellpadding="5">
    <tr>
        <td><b>Fecha: </b>{{ $pago->fecha_cancelado->translatedFormat('d \d\e F \d\e Y') }}</td>
        <td><b>Nro de Documento: </b>{{ $cliente->nro_documento }}</td>
    </tr>
    <tr>
        <td><b>Señor: </b>{{ $cliente->apellidos. " ".$cliente->nombres }}</td>
    </tr>
</table>
<br>
<b>Datos del Pago:</b>
<hr>
<table class="table table-bordered" cellpadding="2">
    <tr>
        <th>Nro</th>
        <th>Detalle</th>
        <th>Monto Pagado</th>
    </tr>
    <tr>
        <td>1</td>
        <td>
            <p>
                <b>Pago del Prestamo: </b> {{ $prestamo->id }} <br>
                <b>Metodo de pago</b> {{ $pago->metodo_pago }}<br>
                <b>{{ $pago->referencia_pago }}</b>
            </p>
        </td>
        <td>
            <p>
                {{ $configuracion->moneda. " " }} {{ $pago->monto_pagado }}
            </p>
        </td>
    </tr>
</table>

<table style="text-align:center" class="table" >
    <tr>
        <td><b>________________________________<br> {{ $configuracion->nombre }} </b> <br> Usuario: {{ Auth::user()->name }}</td>
        <td><b>________________________________<br> Cliente <br></b> {{ $cliente->apellidos. " ".$cliente->nombres }}</td>
    </tr>
</table>
--------------------------------------------------------------------------------------------------------------------------------------------------------------
<!-- Encabezado -->
<table class="table" border="0">
    <tr class="header">
        <td style="text-align: center; width: 50%">
            <img src="{{ public_path('storage/'.$configuracion->logo) }}" alt="Logo"> <br>
            <strong>{{ $configuracion->nombre }}</strong><br>
            {{ $configuracion->descripcion }}<br>
            {{ $configuracion->direccion }}<br>
            Teléfono: {{ $configuracion->telefono }}<br>
            Email: {{ $configuracion->email }}
        </td>
        <td width="300px"></td>
        <td style="text-align: center">
            <b>Nro de Pago: </b> {{ $pago->id }} <br>
            <h3>COPIA</h3>
        </td>
    </tr>
</table>
<p style="text-align:center"><b style="font-size: 18pt"><u>COMPROBANTE DE PAGO</u></b></p>
<br>
<b>Datos del Cliente:</b>
<hr>

<table class="table" cellpadding="5">
    <tr>
        <td><b>Fecha: </b>{{ $pago->fecha_cancelado->translatedFormat('d \d\e F \d\e Y') }}</td>
        <td><b>Nro de Documento: </b>{{ $cliente->nro_documento }}</td>
    </tr>
    <tr>
        <td><b>Señor: </b>{{ $cliente->apellidos. " ".$cliente->nombres }}</td>
    </tr>
</table>
<br>
<b>Datos del Pago:</b>
<hr>
<table class="table table-bordered" cellpadding="2">
    <tr>
        <th>Nro</th>
        <th>Detalle</th>
        <th>Monto Pagado</th>
    </tr>
    <tr>
        <td>1</td>
        <td>
            <p>
                <b>Pago del Prestamo: </b> {{ $prestamo->id }} <br>
                <b>Metodo de pago</b> {{ $pago->metodo_pago }}<br>
                <b>{{ $pago->referencia_pago }}</b>
            </p>
        </td>
        <td>
            <p>
                {{ $configuracion->moneda. " " }} {{ $pago->monto_pagado }}
            </p>
        </td>
    </tr>
</table>

<table style="text-align:center" class="table" >
    <tr>
        <td><b>________________________________<br> {{ $configuracion->nombre }} </b> <br> Usuario: {{ Auth::user()->name }}</td>
        <td><b>________________________________<br> Cliente <br></b> {{ $cliente->apellidos. " ".$cliente->nombres }}</td>
    </tr>
</table>
</body>
</html>
