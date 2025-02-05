<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificación de Pago</title>
</head>
<body>
<h1>Notificación de Pago</h1>
<p>Usted esta atrasado, le pedimos que realize el pago lo mas ante posible</p>
<hr>
<p>
    <b>Detalle del pago:</b> <br><br>
    <b>Monto: {{ $pago->monto_pagado }}</b> <br><br>
    <b>Fecha de Pago: {{ $pago->fecha_pago }}</b> <br><br>
    <b>Estado: {{ $pago->estado }}</b>
    <b>Referencia de Pago: {{ $pago->referencia_pago }}</b> <br>
</p>
</body>
</html>
