@extends('adminlte::page')

@section('content_header')
    <h1><b>Configuraciones / Ver</b></h1>
    <hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Datos de la Configuración</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            @foreach ([
                                'nombre' => ['label' => 'Nombre de la Institución', 'icon' => 'fa-home'],
                                'descripcion' => ['label' => 'Descripción de la Institución', 'icon' => 'fa-university'],
                                'direccion' => ['label' => 'Dirección', 'icon' => 'fa-map-marked'],
                                'telefono' => ['label' => 'Teléfono de la Empresa', 'icon' => 'fa-phone'],
                                'email' => ['label' => 'Correo de la Empresa', 'icon' => 'fa-envelope'],
                                'web' => ['label' => 'Web Empresa', 'icon' => 'fa-pager'],
                                'moneda' => ['label' => 'Moneda', 'icon' => 'fa-coins'],
                                'redes_sociales' => ['label' => 'Redes Sociales', 'icon' => 'fa-share-alt']
                            ] as $field => $data)
                                <div class="{{ $field === 'nombre' ? 'col-md-7' : 'col-md-4' }}">
                                    <div class="form-group">
                                        <label for="{{ $field }}">{{ $data['label'] }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas {{ $data['icon'] }}"></i>
                                                </span>
                                            </div>
                                            @if ($field === 'moneda')
                                                <input type="text" class="form-control" value="{{ $configuracion->$field }}" disabled>
                                            @else
                                                <input type="text" class="form-control" value="{{ $configuracion->$field }}" disabled>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <br>
                            @if ($configuracion->logo)
                                <img src="{{ asset('storage/' . $configuracion->logo) }}" width="100%" alt="Logo">
                            @else
                                <p>No hay logo disponible</p>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('admin.configuracion.index') }}" class="btn btn-secondary btn-block">Volver al Listado</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.configuracion.edit', $configuracion->id) }}" class="btn btn-success btn-block"> <i class="bi bi-pencil"></i>Editar</a>
                    </div>
                    <div class="col-md-4">
                        <form action="{{ route('admin.configuracion.destroy', $configuracion->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $configuracion->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block"  aria-label="Eliminar configuración {{ $configuracion->nombre }}" onclick="confirmDelete({{ $configuracion->id }})"><i class="bi bi-trash"></i>Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
@stop
