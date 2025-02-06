@extends('adminlte::page')

@section('content_header')
    <h1><b>Bienvenido</b></h1>
    <hr>
@stop

@php
$cards = [
    [
        'url' => '/admin/configuracion',
        'icon' => 'fa-cog',
        'title' => 'Configuraciones Registradas',
        'count' => $total_configuraciones,
        'label' => 'Configuraciones',
        'color' => 'bg-info'
    ],
    [
        'url' => '/admin/roles',
        'icon' => 'fa-shield-alt',
        'title' => 'Roles Registrados',
        'count' => $total_roles,
        'label' => 'Roles',
        'color' => 'bg-success'
    ],
    [
        'url' => '/admin/usuarios',
        'icon' => 'fa-users',
        'title' => 'Usuarios Registrados',
        'count' => $total_usuarios,
        'label' => 'Usuarios',
        'color' => 'bg-warning'
    ],
    [
        'url' => '/admin/clientes',
        'icon' => 'fa-users',
        'title' => 'Clientes Registrados',
        'count' => $total_clientes,
        'label' => 'Clientes',
        'color' => 'bg-warning'
    ],
    [
        'url' => '/admin/prestamos',
        'icon' => 'fa-users',
        'title' => 'Prestamos Registrados',
        'count' => $total_prestamos,
        'label' => 'Prestamos',
        'color' => 'bg-warning'
    ],
    [
        'url' => '/admin/pagos',
        'icon' => 'fa-users',
        'title' => 'Pagos Registrados',
        'count' => $total_pagos,
        'label' => 'Pagos',
        'color' => 'bg-warning'
    ],
];
@endphp

@section('content')
<div class="row">
    @foreach($cards as $card)
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP">
            <a href="{{ url($card['url']) }}" class="info-box-icon {{ $card['color'] }}">
                <i class="fas {{ $card['icon'] }}"></i>
            </a>
            <div class="info-box-content">
                <span class="info-box-text"><b>{{ $card['title'] }}</b></span>
                <span class="info-box-number">
                    {{ $card['count'] }} {{ $card['label'] }}
                </span>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Total de Prestamos por mes</h3>
            </div>
            <div class="card-body">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Total de Pagos por mes</h3>
            </div>
            <div class="card-body">
                <div>
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .info-box-content {
            margin-left: 1rem;
            padding: 5px 0;
        }
        .zoomP:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }
    </style>
@stop

@section('js')
@php
    $meses = array_fill(1,12,0);
    $suma_prestamos = array_fill(1, 12, 0);
    foreach($prestamos as $prestamo) {
        $fecha = strtotime(($prestamo['fecha_inicio']));
        $mes = date('n', $fecha);
        $meses[(int)$mes]++;
        $suma_prestamos[(int) $mes] += $prestamo['monto_prestado'];
    }
        $reporte_prestamos = implode(',', $suma_prestamos);


    $meses2 = array_fill(1,12,0);
    $suma_pagos = array_fill(1, 12, 0);
    foreach($pagos as $pago) {
        $fecha2 = strtotime(($pago['fecha_cancelado']));
        $mes2 = date('n', $fecha2);
        $meses2[(int)$mes2]++;
        $suma_pagos[(int) $mes2] += $pago['monto_pagado'];
    }
        $reporte_pagos = implode(',', $suma_pagos);

@endphp
<script>
    var meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre',
        'noviembre', 'diciembre'];
        var datos = [{{ $reporte_prestamos }}];
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: meses,
                datasets: [{
                label: 'Total de Prestamos por mes',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                data: datos,
                borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
</script>
<script>
    var meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre',
        'noviembre', 'diciembre'];
        var datos2 = [{{ $reporte_pagos }}];
        const ctx2 = document.getElementById('myChart2');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                label: 'Total de Prestamos por mes',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                data: datos2,
                borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
</script>
@stop
