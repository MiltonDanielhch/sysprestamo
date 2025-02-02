@extends('adminlte::page')

@section('content_header')
<h1><b>Prestamos Cliente {{ $cliente->apellidos. " ". $cliente->nombres }} </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Historial de Prestamos</h3>
            </div>

            <div class="card-body">
                <table id="mitabla" class="table table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Apellidos y Nombres</th>
                            <th scope="col">Monto Prestado</th>
                            <th scope="col">Tasa de Interes</th>
                            <th scope="col">Modalidad</th>
                            <th scope="col">Nro de Cuotas</th>
                            <th scope="col">Fecha de Inicio</th>
                            <th>Estado del Prestamo</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contador = 1;
                        @endphp
                        @foreach ($prestamos as $prestamo)
                        <tr>
                            <td>{{ $contador++ }}</td>
                            <td>{{ $prestamo->cliente->nro_documento }}</td>
                            <td>{{ $prestamo->cliente->apellidos. " ".$prestamo->cliente->nombres }}</td>
                            <td>{{ $prestamo->monto_prestado }}</td>
                            <td>{{ $prestamo->tasa_interes }}</td>
                            <td>{{ $prestamo->modalidad }}</td>
                            <td>{{ $prestamo->nro_cuotas }}</td>
                            <td>{{ $prestamo->fecha_inicio }}</td>
                            <td>{{ $prestamo->estado }}</td>
                            <td style="text-align: center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('/admin/pagos/prestamos/create',$prestamo->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-money-bill-wave"></i>Ver Pagos</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
