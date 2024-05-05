@extends('layouts/template')

@section('contenido')
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chalkboard-teacher"></i> Editar Profesor
                    </div>

                    <div class="card-body">
                        <form action="{{ route('profesores.update', $profesor->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $profesor->nombre }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $profesor->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ $profesor->telefono }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>

                            <!-- Botón para retroceder -->
                            <a href="{{ route('profesores.index') }}" class="btn btn-secondary">Atrás</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
