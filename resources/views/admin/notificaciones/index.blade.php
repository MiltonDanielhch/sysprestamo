@extends('adminlte::page')

@section('content_header')
<h1><b>Notificaciones/Listado de Pagos </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                {{-- <h3 class="card-title">Registrados Pagos</h3>
                <!-- resources/views/print.blade.php -->
                <button onclick="triggerFlutterTest()">Probar desde JavaScript</button>

                <script>
                function triggerFlutterTest() {
                    if (typeof flutterTestConnection === 'function') {
                        // Parámetros opcionales
                        flutterTestConnection(' 172.22.48.1', 9100);

                        // O sin parámetros
                        // flutterTestConnection();
                    } else {
                        console.error('Flutter no está cargado');
                    }
                }
                </script> --}}

                <div id="flutter-container">
                    <!-- Punto de montaje de Flutter -->
                    <script src="flutter.js" defer></script>
                </div>

                  <button onclick="checkFlutterLoaded()">Probar Conexión</button>

                  <script>
                    let isFlutterReady = false;

                    // Verificar carga de Flutter
                    function checkFlutterLoaded() {
                        if (isFlutterReady) {
                        triggerTest();
                        } else {
                        console.error('Esperando carga de Flutter...');
                        setTimeout(checkFlutterLoaded, 500); // Reintentar cada 500ms
                        }
                    }

                    // Escuchar evento de carga
                    window.addEventListener('flutter-initialized', () => {
                        isFlutterReady = true;
                        console.log('Flutter está listo!');
                    });
                  </script>
            </div>

            <div class="card-body">
                <table id="mitabla" class="table table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Ref Celular</th>
                            <th scope="col">Cuota Pagada</th>
                            <th scope="col">Nro de Cuotas</th>
                            <th scope="col">Fecha de Pago</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contador = 1;
                        @endphp
                        @foreach ($pagos as $pago)
                            {{-- @if(!$pago->fecha_cancelado == null) --}}
                            <tr>
                                <td>{{ $contador++ }}</td>
                                <td>{{ $pago->prestamo->cliente->nro_documento }}</td>
                                <td>{{ $pago->prestamo->cliente->apellidos. " ".$pago->prestamo->cliente->nombres }}</td>
                                <td>{{ $pago->prestamo->cliente->email }}</td>
                                <td>{{ $pago->prestamo->cliente->celular }}</td>
                                <td>{{ $pago->prestamo->cliente->ref_celular }}</td>
                                <td>{{ $pago->monto_pagado }}</td>
                                <td>{{ $pago->referencia_pago }}</td>
                                @if($pago->fecha_pago == date('Y-m-d'))
                                    <td style="text-align:center; background-color: #dbd149;">{{ $pago->fecha_pago }}</td>
                                @elseif($pago->fecha_pago < date('Y-m-d'))
                                    <td style="text-align:center; background-color: #db6b49;">{{ $pago->fecha_pago }}</td>
                                @else
                                    <td style="text-align:center;">{{ $pago->fecha_pago }}</td>
                                @endif
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="https://wa.me/{{ $pago->prestamo->cliente->celular }}?text=Hola Cliente,
                                            {{ $pago->prestamo->cliente->apellidos. ' '.$pago->prestamo->cliente->nombres }}, usted tiene una cuota atrasada, por favor realice el pago lo más antes posible.
                                            @if ($configuracion)
                                                Atte: {{ $configuracion->nombre }}
                                            @else
                                                Atte: Nombre no disponible
                                            @endif" target="_blank" class="btn btn-success btn-sm">
                                            <i class="fas fa-phone"></i>Celular
                                        </a>
                                        <a href="{{ url('/admin/notificaciones/notificar', $pago->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-envelope"></i>Correo
                                        </a>
                                    </div>

                                </td>
                            </tr>
                            {{-- @endif --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
    }
</style>
@stop

@section('js')
<script>
    $('.select2').select2();

    $('.select2').on('change', function(){
        var id = $(this).val();
        if(id){
            window.location.href = "{{ url('/admin/pagos/prestamos/cliente/') }}"+"/"+id;
        }
    });

    $('#mitabla').DataTable({
       "pageLength": 10,
       "language": {
            "processing": "Procesando...",
            "info": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
       }

    });
</script>
@stop
