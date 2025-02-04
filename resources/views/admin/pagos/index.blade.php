@extends('adminlte::page')

@section('content_header')
<h1><b>Listado de Pagos </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Registrados Pagos</h3>

            </div>

            <div class="card-body">
                <table id="mitabla" class="table table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Cliente</th>
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
                            @if(!$pago->fecha_cancelado == null)
                            <tr>
                                <td>{{ $contador++ }}</td>
                                <td>{{ $pago->prestamo->cliente->nro_documento }}</td>
                                <td>{{ $pago->prestamo->cliente->apellidos. " ".$pago->prestamo->cliente->nombres }}</td>
                                <td>{{ $pago->monto_pagado }}</td>
                                <td>{{ $pago->referencia_pago }}</td>
                                <td>{{ $pago->fecha_pago }}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('/admin/pagos',$pago->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{ url('/admin/prestamos/comprobantedepago',$pago->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-print"></i></a>

                                        @if($pago->tiene_cuota_pagada)
                                            {{-- <small>el prestamo ya tiene cuotas pagadas</small> --}}
                                        @else
                                            <form action="{{ url('/admin/pagos',$pago->id) }}" method="post"
                                                onclick="preguntar{{ $pago->id }}(event)" id="miFormulario{{ $pago->id }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        @endif

                                    <script>
                                        function preguntar{{ $pago->id }}(event){
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
                                                        var form = $('#miFormulario{{ $pago->id }}');
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
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Busqueda del Cliente</h3>

            </div>

            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <select name="cliente_id" id="" class="form-control select2">
                        <option value="">Buscar Cliente....</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{$cliente->nro_documento." - ". $cliente->apellidos. " ".$cliente->nombres }}</option>
                        @endforeach
                    </select>
                </div>
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
