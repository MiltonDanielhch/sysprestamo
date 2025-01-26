@extends('adminlte::page')

@section('content_header')
    <h1 class="text-primary font-weight-bold"><i class="fas fa-user-tag mr-2"></i>Listado de Roles</h1>
    <hr class="bg-primary">
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card card-outline card-primary shadow-lg">
                <div class="card-header">
                    <h3 class="card-title">Roles Registrados</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.roles.create') }}"
                           class="btn btn-primary btn-sm elevation-2"
                           data-toggle="tooltip"
                           title="Crear nuevo rol">
                            <i class="fas fa-plus-circle mr-2"></i>Nuevo Rol
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table id="roles-table" class="table table-hover table-striped" style="width:100%">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>#</th>
                                <th>Nombre del Rol</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-truncate" style="max-width: 250px;">{{ $role->name }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.roles.show', $role) }}"
                                           class="btn btn-sm btn-info"
                                           data-toggle="tooltip"
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.roles.edit', $role) }}"
                                           class="btn btn-sm btn-success"
                                           data-toggle="tooltip"
                                           title="Editar rol">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.roles.destroy', $role) }}"
                                              method="POST"
                                              class="d-inline"
                                              data-delete-form>
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-sm btn-danger"
                                                    data-toggle="tooltip"
                                                    title="Eliminar rol"
                                                    onclick="confirmDelete(event, '{{ $role->name }}')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
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
</div>
@stop

@section('css')
<style>
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.25em 0.75em;
        border-radius: 0.25rem;
    }
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
    }
</style>
@stop

@section('js')
<script>
    // DataTables Initialization
    $(document).ready(function() {
        var table = $('#roles-table').DataTable({  // Cambié aquí el ID al correcto
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
        }).buttons().container().appendTo('#roles-table_wrapper .col-md-6:eq(0)');  // Cambié aquí también el ID
    });
</script>
<script>
    // Función de confirmación de eliminación
    function confirmDelete(event, roleName) {
        event.preventDefault();
        Swal.fire({
            title: `¿Eliminar ${roleName}?`,
            text: "¡Esta acción no se puede revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.closest('form').submit();
            }
        });
    }

    // Mostrar notificaciones
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>
@stop
