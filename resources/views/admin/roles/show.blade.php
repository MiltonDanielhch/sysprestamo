@extends('adminlte::page')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-user-tag mr-2"></i><b>Detalle del Rol</b></h1>
    <hr class="bg-primary">
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card card-outline card-primary shadow">
                <div class="card-header bg-white">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle text-primary mr-2"></i>
                        Información del Rol
                    </h3>
                </div>

                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4 text-md-right">
                            <i class="fas fa-id-card text-primary"></i> Nombre:
                        </dt>
                        <dd class="col-sm-8">
                            <span class="badge badge-primary p-2">{{ $role->name }}</span>
                        </dd>

                        <dt class="col-sm-4 text-md-right">
                            <i class="fas fa-shield-alt text-primary"></i> Guard Name:
                        </dt>
                        <dd class="col-sm-8">
                            <code>{{ $role->guard_name }}</code>
                        </dd>

                        <dt class="col-sm-4 text-md-right">
                            <i class="fas fa-calendar-plus text-primary"></i> Creado:
                        </dt>
                        <dd class="col-sm-8">
                            {{ $role->created_at->format('d/m/Y H:i') }}
                        </dd>

                        <dt class="col-sm-4 text-md-right">
                            <i class="fas fa-calendar-check text-primary"></i> Actualizado:
                        </dt>
                        <dd class="col-sm-8">
                            {{ $role->updated_at->format('d/m/Y H:i') }}
                        </dd>
                    </dl>
                </div>

                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left mr-2"></i> Volver al listado
                        </a>

                        @can('edit roles')
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning">
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
    }
    dd {
        font-size: 1.1em;
    }
    .card-header {
        border-bottom: 2px solid #007bff;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Agrega efectos de hover a los botones
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseover', () => {
                button.style.transform = 'scale(1.02)';
                button.style.transition = 'transform 0.3s ease';
            });
            button.addEventListener('mouseout', () => {
                button.style.transform = 'scale(1)';
            });
        });
    });
</script>
@stop
