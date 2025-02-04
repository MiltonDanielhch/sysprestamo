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
@stop
