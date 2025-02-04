<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Préstamo</title>
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
    @php
        use Carbon\Carbon;
    @endphp

    <!-- Encabezado -->
    <table class="table" border="0">
        <tr class="header">
            <td style="text-align: center; width: 50%">
                <strong>{{ $configuracion->nombre }}</strong><br>
                {{ $configuracion->descripcion }}<br>
                {{ $configuracion->direccion }}<br>
                Teléfono: {{ $configuracion->telefono }}<br>
                Email: {{ $configuracion->email }}
            </td>
            <td style="text-align: center; width: 50%">
                <img src="{{ public_path('storage/'.$configuracion->logo) }}" alt="Logo">
            </td>
        </tr>
    </table>

    <!-- Título principal -->
    <h1 style="text-align: center; margin: 10px 0">
        <u>CONTRATO DE PRÉSTAMO N° {{ $prestamo->id }}</u>
    </h1>

    <!-- Sección Cliente -->
    <h3>Datos del Cliente</h3>
    <hr>
    <table class="table">
        <tr>
            <th width="20%">Documento:</th>
            <td width="30%">{{ $prestamo->cliente->nro_documento }}</td>
            <th width="20%">Correo Electrónico:</th>
            <td width="30%">{{ $prestamo->cliente->email }}</td>
        </tr>
        <tr>
            <th>Cliente:</th>
            <td>{{ $prestamo->cliente->apellidos." ".$prestamo->cliente->nombres }}</td>
            <th>Celular:</th>
            <td>{{ $prestamo->cliente->celular }}</td>
        </tr>
        <tr>
            <th>Fecha de Nacimiento:</th>
            <td>{{ Carbon::parse($prestamo->cliente->fecha_nacimiento)->format('d/m/Y') }}</td>
            <th>Referencia Celular:</th>
            <td>{{ $prestamo->cliente->ref_celular }}</td>
        </tr>
        <tr>
            <th>Género:</th>
            <td>{{ $prestamo->cliente->genero }}</td>
            <th colspan="2"></th>
        </tr>
    </table>

    <!-- Sección Préstamo -->
    <h3>Detalles del Préstamo</h3>
    <hr>
    <table class="table">
        <tr>
            <th width="25%">Monto del Préstamo:</th>
            <td width="25%">{{ $configuracion->moneda }} {{ number_format($prestamo->monto_prestado, 2) }}</td>
            <th width="25%">Tasa de Interés:</th>
            <td width="25%">{{ $prestamo->tasa_interes }}%</td>
        </tr>
        <tr>
            <th>Modalidad de Pago:</th>
            <td>{{ $prestamo->modalidad }}</td>
            <th>Número de Cuotas:</th>
            <td>{{ $prestamo->nro_cuotas }}</td>
        </tr>
        <tr>
            <th>Monto Total a Pagar:</th>
            <td>{{ $configuracion->moneda }} {{ number_format($prestamo->monto_total, 2) }}</td>
            <th>Estado:</th>
            <td>{{ ucfirst($prestamo->estado) }}</td>
        </tr>
    </table>

    <!-- Sección Pagos -->
    <h3>Plan de Pagos</h3>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th width="10%">Cuota</th>
                <th width="30%">Fecha de Pago</th>
                <th width="30%">Monto</th>
                <th width="30%">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pagos as $pago)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                <td>{{ $configuracion->moneda }} {{ number_format($pago->monto_pagado, 2) }}</td>
                <td>{{ ucfirst($pago->estado) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center">No se registran pagos</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pie de página -->
    <div class="footer">
        Documento generado el: {{ Carbon::now()->format('d/m/Y H:i') }}<br>
        {{ $configuracion->nombre }} - Todos los derechos reservados
    </div>
</body>
</html>
