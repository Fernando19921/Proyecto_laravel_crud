@extends('layouts/template')

@section('contenido')
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-book"></i> Editar Materia
                    </div>

                    <div class="card-body">
                        <form action="{{ route('aulas.update', $salon->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $salon->nombre }}">
                            </div>
                            <!-- Mensaje de error si el nombre ya existe -->
                            @if ($errors->has('nombre'))
                            <div class="alert alert-danger">El nombre del aula ya existe.</div>
                            @endif
                         
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>

                            <!-- Botón para retroceder -->
                            <a href="{{ route('materias.index') }}" class="btn btn-secondary">Atrás</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
