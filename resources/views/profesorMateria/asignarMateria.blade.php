@extends('layouts.template')

@section('contenido')
<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chalkboard-teacher opacity-10"></i> Asignar Materia Profesor
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>Esta Materia ya esta asignada a este profesor</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('asignarMateria.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="profesor_id" class="form-label">Profesor:</label>
                            <select name="profesor_id" id="profesor_id" class="form-control" required>
                                <option value="">Seleccione un profesor</option>
                                @foreach ($profesores as $profesor)
                                    <option value="{{ $profesor->id }}">{{ $profesor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="materia_id" class="form-label">Materia:</label>
                            <select name="materia_id" id="materia_id" class="form-control" required>
                                <option value="">Seleccione una materia</option>
                                @foreach ($materias as $materia)
                                    <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Asignar Materia</button>
                        <a href="{{ route('asignarMateria.index') }}" class="btn btn-secondary">Atrás</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
