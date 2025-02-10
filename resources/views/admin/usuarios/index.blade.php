@extends('adminlte::page')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-users mr-2"></i><b>Listado de Usuarios</b></h1>
    <hr class="bg-primary">
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary shadow">
                <div class="card-header bg-white">
                    <h3 class="card-title">
                        <i class="fas fa-user-friends text-primary mr-2"></i>
                        Usuarios Registrados
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.usuarios.create') }}"
                           class="btn btn-primary btn-sm elevation-2"
                           data-toggle="tooltip"
                           title="Crear nuevo usuario">
                            <i class="fas fa-plus-circle mr-2"></i>Nuevo
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table id="usuarios-table" class="table table-hover table-striped" style="width:100%">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @foreach($usuario->roles as $role)
                                        <span class="badge badge-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.usuarios.show', $usuario) }}"
                                           class="btn btn-sm btn-info"
                                           data-toggle="tooltip"
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.usuarios.edit', $usuario) }}"
                                           class="btn btn-sm btn-success"
                                           data-toggle="tooltip"
                                           title="Editar usuario">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if (!($usuario->roles->pluck('name')->implode(', ') === 'Administrador'))
                                        <form action="{{ route('admin.usuarios.destroy', $usuario) }}"
                                                method="POST"
                                                class="d-inline"
                                                data-delete-form>
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-sm btn-danger"
                                                    data-toggle="tooltip"
                                                    title="Eliminar usuario"
                                                    onclick="confirmarEliminacion(event)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @endif

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
.dataTables_wrapper .dt-buttons {
margin-bottom: 10px;
gap: 5px;
}

.dataTables_wrapper .dataTables_filter {
    padding-top: 5px;
}
</style>
@stop

@section('js')


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar DataTables con botones
        $('#usuarios-table').DataTable({
            language: {
                // url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            dom: "<'row'<'col-sm-6'f><'col-sm-6 text-right'B>>" +
         "<'row'<'col-sm-12'tr>>" +
         "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'collection',
                    text: '<i class="fas fa-download mr-2"></i>Exportar',
                    className: 'btn btn-primary btn-sm',
                    buttons: [
                        {
                            extend: 'copy',
                            text: '<i class="fas fa-copy mr-2"></i>Copiar',
                            className: 'btn btn-secondary btn-sm',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel mr-2"></i>Excel',
                            className: 'btn btn-success btn-sm',
                            filename: 'Usuarios_'+new Date().toISOString().split('T')[0],
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf mr-2"></i>PDF',
                            className: 'btn btn-danger btn-sm',
                            orientation: 'landscape',
                            filename: 'Usuarios_'+new Date().toISOString().split('T')[0],
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            customize: function(doc) {
                                doc.content[1].table.widths =
                                    Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                                doc.styles.tableHeader.alignment = 'left';
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print mr-2"></i>Imprimir',
                            className: 'btn btn-info btn-sm',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        }
                    ]
                }
            ],
            columnDefs: [
                { orderable: false, targets: [4] },
                { className: 'text-center', targets: [4] }
            ],
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            order: [[1, 'asc']]
        });

        // Inicializar tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Función de confirmación de eliminación (mantener igual)
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: '¿Confirmar eliminación?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@stop

{{-- @section('css')
<style>
    .badge {
        font-size: 0.85em;
        margin: 2px;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar DataTables
        $('#usuarios-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            columnDefs: [
                { orderable: false, targets: [4] },
                { className: 'text-center', targets: [4] }
            ],
            responsive: true,
            autoWidth: false
        });

        // Inicializar tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Función de confirmación de eliminación
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: '¿Confirmar eliminación?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@stop --}}
