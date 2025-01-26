@extends('adminlte::page')

@section('content_header')
    <h1><b>Configuraciones / Crear</b></h1>
    <hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.configuracion.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                @foreach ([
                                    'nombre' => ['label' => 'Nombre de la Institución', 'type' => 'text', 'icon' => 'fa-home'],
                                    'descripcion' => ['label' => 'Descripción de la Institución', 'type' => 'text', 'icon' => 'fa-university'],
                                    'direccion' => ['label' => 'Dirección', 'type' => 'text', 'icon' => 'fa-map-marked'],
                                    'telefono' => ['label' => 'Teléfono de la Empresa', 'type' => 'text', 'icon' => 'fa-phone'],
                                    'email' => ['label' => 'Correo de la Empresa', 'type' => 'email', 'icon' => 'fa-envelope'],
                                    'web' => ['label' => 'Web Empresa', 'type' => 'url', 'icon' => 'fa-pager'],
                                    'moneda' => ['label' => 'Moneda', 'type' => 'select', 'icon' => 'fa-coins', 'options' => [
                                        'usd' => 'Dólar Estadounidense (USD)',
                                        'bs' => 'Boliviano (BS)',
                                        'eur' => 'Euro (EUR)',
                                        'gbp' => 'Libra Esterlina (GBP)',
                                        'jpy' => 'Yen Japonés (JPY)',
                                        'mxn' => 'Peso Mexicano (MXN)',
                                        'ars' => 'Peso Argentino (ARS)',
                                        'brl' => 'Real Brasileño (BRL)',
                                        'cad' => 'Dólar Canadiense (CAD)',
                                        'chf' => 'Franco Suizo (CHF)'
                                    ]],
                                    'redes_sociales' => ['label' => 'Redes Sociales', 'type' => 'text', 'icon' => 'fa-share-alt']
                                ] as $field => $data)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="{{ $field }}">{{ $data['label'] }}</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas {{ $data['icon'] }}"></i></span>
                                                </div>
                                                @if ($data['type'] === 'select')
                                                    <select name="{{ $field }}" id="{{ $field }}" class="form-control" required>
                                                        @foreach ($data['options'] as $value => $label)
                                                            <option value="{{ $value }}">{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="{{ $data['type'] }}"
                                                           name="{{ $field }}"
                                                           id="{{ $field }}"
                                                           class="form-control"
                                                           required>
                                                @endif
                                            </div>
                                            @error($field)
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" id="file" name="logo" accept=".jpg, .jpeg, .png" class="form-control">
                                @error('logo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <br>
                                <center>
                                    <output id="list">
                                        <img src="" width="80%" alt="logo">
                                    </output>
                                </center>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block">Registrar datos</button>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.configuracion.index') }}" class="btn btn-secondary btn-block">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    document.getElementById('file').addEventListener('change', function(evt) {
        var files = evt.target.files;
        var output = document.getElementById('list');
        output.innerHTML = '';

        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) continue;

            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    output.innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="70%" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }, false);
</script>
@stop
