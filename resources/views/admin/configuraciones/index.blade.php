@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Configuraciones</b></h1>
    <hr>
@stop

@section('content')
<div class="col-md-12">
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Configuraciones Registradas</h3>
            <div class="card-tools">
                <a href="{{ route('admin.configuracion.create') }}" class="btn btn-primary">Crear Nuevo</a>
            </div>
        </div>
        <div class="card-body">
            <table id="table1" class="table table-bordered table-striped table-hover table-responsive-sm" role="grid">
                <thead>
                    <tr>
                        <th scope="col">Nro</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Email</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Acción</th> <!-- Nueva columna de acción -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($configuraciones as $configuracion)
                        <tr>
                            <td>{{ $configuracion->id }}</td>
                            <td class="text-truncate" style="max-width: 150px;">{{ $configuracion->nombre }}</td>
                            <td class="text-truncate" style="max-width: 200px;">{{ $configuracion->descripcion }}</td>
                            <td>{{ $configuracion->telefono }}</td>
                            <td><a href="mailto:{{ $configuracion->email }}" class="text-info">{{ $configuracion->email }}</a></td>
                            <td>
                                <img src="{{ asset('storage/' . $configuracion->logo) }}"
                                     alt="Logo de la configuración"
                                     class="img-thumbnail"
                                     style="width: 50px; height: auto;">
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-group" role="group" aria-label="Acciones">
                                    <!-- Ver -->
                                    <a href="{{ route('admin.configuracion.show', $configuracion->id) }}" type="button" class="btn btn-info btn-sm" aria-label="Ver configuración {{ $configuracion->nombre }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <!-- Editar -->
                                    <a href="{{ route('admin.configuracion.edit', $configuracion->id) }}" type="button" class="btn btn-success btn-sm" aria-label="Editar configuración {{ $configuracion->nombre }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.configuracion.destroy', $configuracion->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $configuracion->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" aria-label="Eliminar configuración {{ $configuracion->nombre }}" onclick="confirmDelete({{ $configuracion->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- {{ $configuraciones->links() }} <!-- Pagination --> --}}
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    #table1_wrapper .dt-buttons {
        background-color: transparent;
        box-shadow: none;
        border: none;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    #table1_wrapper .btn {
        color: #ffffff;
        border-radius: 4px;
        padding: 5px 15px;
        font-size: 14px;
    }

    .btn-danger { background-color: #dc3545; border: none; }
    .btn-success { background-color: #28a745; border: none; }
    .btn-info { background-color: #17a2b8; border: none; }
    .btn-warning { background-color: #ffc107; color: #212529; border: none; }
    .btn-default { background-color: #6e7176; color: #212529; border: none; }

    /* Mejoras en la accesibilidad y estilo */
    .text-truncate {
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
</style>
@stop

@section('js')
<script>
    function confirmDelete(configId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma la eliminación, enviamos el formulario.
                document.getElementById('delete-form-' + configId).submit();
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        var table = $('#table1').DataTable({
            "language": {
                "decimal": ",",
                "thousands": ".",
                "info": "Mostrando registros _START_ a _END_ de _TOTAL_",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "loadingRecords": "Cargando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "processing": "Procesando...",
                "search": "Buscar:",
                "searchPlaceholder": "Término de búsqueda",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "buttons": [
                {
                    extend: 'collection',
                    text: 'Generar Reporte',
                    className: 'btn btn-primary',
                    buttons: [
                        {
                            text: 'COPIAR',
                            extend: 'copy',
                            className: 'btn btn-default btn-sm'
                        },
                        {
                            text: 'PDF',
                            extend: 'pdf',
                            className: 'btn btn-danger btn-sm'
                        },
                        {
                            text: 'CSV',
                            extend: 'csv',
                            className: 'btn btn-info btn-sm'
                        },
                        {
                            text: 'EXCEL',
                            extend: 'excel',
                            className: 'btn btn-success btn-sm'
                        },
                        {
                            text: 'IMPRIMIR',
                            extend: 'print',
                            className: 'btn btn-warning btn-sm'
                        }
                    ]
                },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    className: 'btn btn-light'
                }
            ]
        }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
    });
</script>
@stop
