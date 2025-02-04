@extends('adminlte::page')

@section('content_header')
    <h1><b>Préstamos / Registro de un Nuevo Pago</b></h1>
    <hr>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sección de Datos del Cliente -->
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
                                <i class="fas fa-id-card"></i> {{ $prestamo->cliente->nro_documento }} <br><br>
                                <b>Nombre y Apellido</b> <br>
                                <i class="fas fa-user"></i> {{ $prestamo->cliente->apellidos . " " . $prestamo->cliente->nombres }} <br><br>
                                <b>Fecha de Nacimiento</b> <br>
                                <i class="fas fa-calendar"></i> {{ $prestamo->cliente->fecha_nacimiento }} <br><br>
                                <b>Género</b> <br>
                                <i class="fas fa-user-check"></i> {{ $prestamo->cliente->genero }} <br><br>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <b>Email</b> <br>
                            <i class="fas fa-envelope"></i> {{ $prestamo->cliente->email }} <br><br>
                            <b>Celular</b> <br>
                            <i class="fas fa-phone"></i> {{ $prestamo->cliente->celular }} <br><br>
                            <b>Referencia de Celular</b> <br>
                            <i class="fas fa-phone-alt"></i> {{ $prestamo->cliente->ref_celular }} <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Datos del Préstamo -->
        <div class="col-md-3">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos del Préstamo</h3>
                </div>
                <div class="card-body">
                    <p>
                        <b>Monto Prestado</b> <br>
                        <i class="fas fa-money-bill-wave"></i> {{ number_format($prestamo->monto_prestado, 2) }} <br><br>
                        <b>Tasa de Interés</b> <br>
                        <i class="fas fa-percentage"></i> {{ $prestamo->tasa_interes }}% <br><br>
                        <b>Modalidad</b> <br>
                        <i class="fas fa-calendar-alt"></i> {{ $prestamo->modalidad }} <br><br>
                        <b>Nro de Cuotas</b> <br>
                        <i class="fas fa-list"></i> {{ $prestamo->nro_cuotas }} <br><br>
                        <b>Monto Total</b> <br>
                        <i class="fas fa-money-bill-alt"></i> {{ number_format($prestamo->monto_total, 2) }} <br><br>
                    </p>
                </div>
            </div>
        </div>

        <!-- Sección de Pagos -->
        <div class="col-md-5">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos del Pago</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nro Cuota</th>
                                <th>Monto Cuota</th>
                                <th>Fecha Pago</th>
                                <th>Estado</th>
                                <th>Fecha Cancelado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pagos as $pago)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ number_format($pago->monto_pagado, 2) }}</td>
                                <td>{{ $pago->fecha_pago }}</td>
                                <td>{{ $pago->estado }}</td>
                                <td>{{ $pago->fecha_cancelado ?? 'N/A' }}</td>
                                <td>
                                    @if($pago->estado == "Confirmado")
                                        <button class="btn btn-danger btn-sm" disabled>
                                            <i class="fas fa-check-circle"></i> Pagado
                                        </button>
                                        <a href="{{ url('/admin/prestamos/comprobantedepago', $pago->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-print"></i> Imprimir
                                        </a>
                                    @else
                                        <form action="{{ route('admin.pagos.update', $pago->id) }}" method="POST" class="d-inline form-confirmar">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-money-bill-wave"></i> Pagar
                                            </button>
                                        </form>
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

@if(session('mensaje'))
<script>
    Swal.fire({
        icon: '{{ session('icono') }}',
        title: '{{ session('mensaje') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@section('js')
<script>
    // Configuración general para todos los formularios de confirmación
    document.querySelectorAll('.form-confirmar').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Confirmar pago?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, confirmar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection
@endsection
