@extends('layouts/template')

@section('contenido')
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chalkboard-teacher"></i> Editar Materia
                    </div>

                    <div class="card-body">
                        <form action="{{ route('materias.update', $materias->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $materias->nombre }}">
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripcion:</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $materias->descripcion }}">
                            </div>

                         
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
