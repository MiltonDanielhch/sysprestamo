@extends('adminlte::page')

@section('content_header')
<h1><b>Prestamos/registro de un nuevo Pago </b></h1>
<hr>
@stop

@section('content')
<form action="{{ route('admin.pagos.store') }}" method="post">
    @csrf
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
                                        <th>Accion</th>
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
                                        <td>
                                            @if($pago->estado == "Confirmado")
                                                <button type="button" class="btn btn-danger btn-sm">Cancelado</button>
                                            @else
                                                <!-- Formulario de pago -->
                                                <form action="{{ route('admin.pagos.update', $pago->id) }}" method="POST" id="miFormulario{{ $pago->id }}"  class="confirm-payment-form"> <!-- Added common class -->

                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-money-bill"></i> Pagar
                                                    </button>
                                                </form>
                                                <!-- Confirmación antes de enviar el formulario -->
                                                {{-- <script>
                                                    document.getElementById('miFormulario{{ $pago->id }}').addEventListener('submit', function(event){
                                                        event.preventDefault(); // Evita el envío inmediato del formulario
                                                        Swal.fire({
                                                            title: "¿Estás seguro de registrar el pago?",
                                                            icon: "question",
                                                            showCancelButton: true,
                                                            confirmButtonColor: "#3085d6",
                                                            cancelButtonColor: "#d33",
                                                            cancelButtonText: "Cancelar",
                                                            confirmButtonText: "Sí"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                this.submit(); // Envía el formulario si se confirma
                                                            }
                                                        });
                                                    });
                                                </script> --}}
                                            @endif
                                        </td>
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
</form>
@stop

@section('css')
@stop


@section('js')
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle all payment forms with class 'confirm-payment-form'
    document.querySelectorAll('.confirm-payment-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Confirmar pago?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, registrar pago'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@stop
