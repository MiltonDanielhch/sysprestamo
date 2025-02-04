@extends('adminlte::page')

@section('content_header')
<h1><b>Pagos/Datos del Pago </b></h1>
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
                        <p>
                            <b>Monto Pagado: </b><i class="fas fa-money-bill-wave"></i> {{ $pago->monto_pagado }} <br><br>
                            <b>Metodo de Pago: </b><i class="fas fa-money-bill-wave"></i> {{ $pago->metodo_pago }} <br><br>
                            <b>{{ $pago->referencia_pago }} </b> <br><br>
                            <b>Estado: </b> {{ $pago->estado }} <br><br>
                            <b>Fecha Cancelado: </b><i class="fas fa-calendar-alt"></i> {{ $pago->fecha_cancelado }} <br><br>
                        </p>
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
