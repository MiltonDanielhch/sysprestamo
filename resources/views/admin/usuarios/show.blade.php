@extends('adminlte::page')

@section('content_header')
    <h1 class="text-info"><i class="fas fa-user-circle mr-2"></i><b>Detalle del Usuario</b></h1>
    <hr class="bg-info">
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-outline card-info shadow-lg">
                <div class="card-header bg-white">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle text-info mr-2"></i>
                        Información del Usuario
                    </h3>
                </div>

                <div class="card-body">
                    <dl class="row">
                        <!-- Sección de Datos Básicos -->
                        <div class="col-md-12 mb-4">
                            <h5 class="text-info"><i class="fas fa-id-card mr-2"></i>Datos Principales</h5>
                            <hr class="bg-info">
                        </div>

                        <dt class="col-sm-4 text-md-right">
                            <i class="fas fa-user-tag text-info"></i> Roles:
                        </dt>
                        <dd class="col-sm-8">
                            @foreach($usuario->roles as $role)
                                <span class="badge badge-info">{{ $role->name }}</span>
                            @endforeach
                        </dd>

                        <dt class="col-sm-4 text-md-right">
                            <i class="fas fa-user text-info"></i> Nombre:
                        </dt>
                        <dd class="col-sm-8">{{ $usuario->name }}</dd>

                        <dt class="col-sm-4 text-md-right">
                            <i class="fas fa-envelope text-info"></i> Email:
                        </dt>
                        <dd class="col-sm-8">{{ $usuario->email }}</dd>

                        <!-- Sección de Metadatos -->
                        <div class="col-md-12 mb-4 mt-4">
                            <h5 class="text-info"><i class="fas fa-history mr-2"></i>Registro</h5>
                            <hr class="bg-info">
                        </div>

                        <dt class="col-sm-4 text-md-right">
                            <i class="fas fa-calendar-plus text-info"></i> Creado:
                        </dt>
                        <dd class="col-sm-8">
                            {{ $usuario->created_at->isoFormat('LLLL') }}
                        </dd>

                        <dt class="col-sm-4 text-md-right">
                            <i class="fas fa-calendar-check text-info"></i> Actualizado:
                        </dt>
                        <dd class="col-sm-8">
                            {{ $usuario->updated_at->isoFormat('LLLL') }}
                        </dd>
                    </dl>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.usuarios.index') }}"
                           class="btn btn-outline-info"
                           data-toggle="tooltip"
                           title="Volver al listado de usuarios">
                            <i class="fas fa-arrow-left mr-2"></i> Volver
                        </a>

                        @can('update', $usuario)
                        <a href="{{ route('admin.usuarios.edit', $usuario) }}"
                           class="btn btn-warning"
                           data-toggle="tooltip"
                           title="Editar usuario">
                            <i class="fas fa-edit mr-2"></i> Editar
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    dt {
        font-weight: 500;
        padding: 0.75rem 0;
    }
    dd {
        padding: 0.75rem 0;
        font-size: 1.05em;
    }
    .badge {
        font-size: 0.9em;
        padding: 0.6em;
        margin: 0.2em;
    }
    .mb-4{
        margin-bottom: -1.5rem !important;
    }
    .content-header {
        padding: 5px .5rem;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Animación hover en tarjeta
        const card = document.querySelector('.card');
        card.addEventListener('mouseover', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.transition = 'transform 0.3s ease';
        });
        card.addEventListener('mouseout', () => {
            card.style.transform = 'translateY(0)';
        });
    });
</script>
@stop
