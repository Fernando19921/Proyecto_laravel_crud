@extends('layouts/template')

@section('contenido')
<main>
    <div class="container py-4">
        <h2>{{ $msg }}</h2>
        <a href="{{ route($ruta) }}" class="btn btn-secondary">Regresar</a>
   </div>
</main>
    
@endsection
