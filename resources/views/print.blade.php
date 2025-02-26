@extends('adminlte::page')

@section('content_header')
<h1><b>Notificaciones/Listado de Pagos </b></h1>
<hr>
@stop


{{-- @section('content')
<!-- resources/views/print.blade.php -->
<button onclick="triggerPrintTest()" class="btn btn-primary">
    Imprimir Test desde Laravel
</button>

<script>
function triggerPrintTest() {
    fetch('/api/print-test', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            ip: '172.22.48.1',
            port: 9100
        })
    })
    .then(response => response.json())
    .then(data => console.log('Job creado:', data));
}
</script>
@stop --}}
