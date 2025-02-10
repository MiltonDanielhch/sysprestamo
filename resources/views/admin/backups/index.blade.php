@extends('adminlte::page')

@section('content_header')
<h1><b>Listado de Backups </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Backups Creados</h3>

                <div class="card-tools">
                    {{-- <a href="/admin/backups/create" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Nuevo</a> --}}
                    <form action="{{ route('admin.backups.create') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Crear Nuevo Backup</button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                @if(session('mensaje'))
                    <div class="alert alert-{{ session('icono') }} alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('mensaje') }}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tamaño</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backupData as $backup)
                            <tr>
                                <td>{{ $backup['nombre'] }}</td>
                                <td>{{ number_format($backup['tamaño'] / 1024 / 1024, 2) }} MB</td>
                                <td>{{ \Carbon\Carbon::createFromTimestamp($backup['fecha'])->format('d/m/Y H:i') }}</td>
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
