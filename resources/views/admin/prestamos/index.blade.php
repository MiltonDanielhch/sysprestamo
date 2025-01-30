@extends('adminlte::page')

@section('content_header')
<h1><b>Listado de Prestamos </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Clientes Prestamos</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.prestamos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Nuevo</a>
                </div>
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
                            <td style="text-align: center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('/admin/prestamos',$prestamo->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ url('/admin/prestamos/contratos',$prestamo->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-print"></i></a>
                                    @if($prestamo->tiene_cuota_pagada)
                                        {{-- <small>el prestamo ya tiene cuotas pagadas</small> --}}
                                    @else
                                        <a href="{{ url('/admin/prestamos/'.$prestamo->id.'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ url('/admin/prestamos',$prestamo->id) }}" method="post"
                                            onclick="preguntar{{ $prestamo->id }}(event)" id="miFormulario{{ $prestamo->id }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    @endif

                                <script>
                                    function preguntar{{ $prestamo->id }}(event){
                                        event.preventDefault();
                                        Swal.fire({
                                            title: "¿Desea Eliminar este registro?",
                                            text: "",
                                            icon: "question",
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            cancelButtonText: "Cancelar",
                                            confirmButtonText: "Eliminar"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    var form = $('#miFormulario{{ $prestamo->id }}');
                                                    form.submit();
                                                    // title: "Deleted!",
                                                    // text: "Your file has been deleted.",
                                                    // icon: "success"
                                                }
                                        });
                                    }
                                </script>
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
<script>
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
