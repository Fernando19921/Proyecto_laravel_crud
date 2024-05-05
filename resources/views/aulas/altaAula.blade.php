@extends('layouts.template')

@section('contenido')
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chair"></i> Agregar Aula <!-- Icono de aula -->
                    </div>
                    <div class="card-body">
                        <form action="{{ route('aulas.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre Del Aula</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            @if ($errors->has('nombre'))
                            <div class="alert alert-danger">El nombre del aula ya existe.</div>
                            @endif
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
