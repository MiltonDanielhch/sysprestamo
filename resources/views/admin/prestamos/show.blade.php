@extends('adminlte::page')

@section('content_header')
<h1><b>Prestamos/registro de un nuevo Prestamo </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos del Cliente</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <b>Nro Documento</b> <br>
                            <i class="fas fa-id-card"></i>{{ $prestamo->cliente->nro_documento }} <br> <br>
                            <b>Nombre y Apellido</b> <br>
                            <i class="fas fa-user"></i>{{ $prestamo->cliente->apellido." ".$prestamo->cliente->nombres }} <br> <br>
                            <b>Fecha de Nacimiento</b> <br>
                            <i class="fas fa-calendar"></i>{{ $prestamo->cliente->fecha_nacimiento  }} <br> <br>
                            <b>Genero</b> <br>
                            <i class="fas fa-user-check"></i>{{ $prestamo->cliente->genero }} <br> <br>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <b>Email</b> <br>
                        <i class="fas fa-envelope"></i>{{ $prestamo->cliente->email }} <br> <br>
                        <b>Celular</b> <br>
                        <i class="fas fa-envelope"></i>{{ $prestamo->cliente->celular }} <br> <br>
                        <b>Referencia de Celular</b> <br>
                        <i class="fas fa-envelope"></i>{{ $prestamo->cliente->ref_celular }} <br> <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos del Prestamo</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <b>Monto Prestamo</b> <br>
                            <i class="fas fa-money-bill-wave"></i>{{ $prestamo->monto_prestado }} <br> <br>
                            <b>Tasa de Interes</b> <br>
                            <i class="fas fa-percentage"></i>{{ $prestamo->tasa_interes }} <br> <br>
                            <b>Modalidad</b> <br>
                            <i class="fas fa-calendar-alt"></i>{{ $prestamo->modalidad }} <br> <br>
                            <b>Nro de Cuotas</b> <br>
                            <i class="fas fa-list"></i>{{ $prestamo->nro_cuotas }} <br> <br>
                            <b>Monto Total</b> <br>
                            <i class="fas fa-money-bill-alt"></i>{{ $prestamo->monto_total }} <br> <br>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos del Pago</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12">
                        <table class="table table-sm table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Nro de Cuota</th>
                                    <th>Monto de la Cuota</th>
                                    <th>Fecha de pago</th>
                                    <th>Estado</th>
                                    <th>Fecha Cancelado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $contador = 1;
                                @endphp
                                @foreach($pagos as $pago)
                                    <tr>
                                        <td>{{ $contador++ }}</td>
                                        <td>{{ $pago->monto_pagado }}</td>
                                        <td>{{ $pago->fecha_pago }}</td>
                                        <td>{{ $pago->estado }}</td>
                                        <td>{{ $pago->fecha_cancelado }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
