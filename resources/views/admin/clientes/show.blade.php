@extends('adminlte::page')

@section('content_header')
<h1><b>Clientes/Datos del Cliente </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>

            <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nro_documento">Documento</label>
                                <p>{{ $cliente->nro_documento }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombres">Nombre del Cliente</label>
                                <p>{{ $cliente->nombres }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellidos">Apellido del Cliente</label>
                                <p>{{ $cliente->apellidos }}</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <p>{{ $cliente->fecha_nacimiento }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="genero">Genero</label>
                                <p>{{ $cliente->genero }}</p>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <p>{{ $cliente->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <p>{{ $cliente->celular }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ref_celular">Referencia Celular</label>
                                <p>{{ $cliente->ref_celular }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary"> Cancelar</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')

@stop
