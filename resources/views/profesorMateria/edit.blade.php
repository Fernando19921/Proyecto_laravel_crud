@extends('layouts.template')

@section('contenido')
<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chalkboard-teacher opacity-10"></i> Editar Asignación de Materia
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('asignarMateria.update', $profesor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="profesor_id" class="form-label">Profesor:</label>
                            <select name="profesor_id" id="profesor_id" class="form-control" required>
                                <option value="">Seleccione un profesor</option>
                                @foreach ($profesores as $prof)
                                    <option value="{{ $prof->id }}" {{ $prof->id == $profesor->id ? 'selected' : '' }}>{{ $prof->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="materia_id" class="form-label">Materia:</label>
                            <select name="materia_id" id="materia_id" class="form-control" required>
                                <option value="">Seleccione una materia</option>
                                @foreach ($materias as $materia)
                                    <option value="{{ $materia->id }}" {{ $materia->id == $materiaAsignada->id ? 'selected' : '' }}>{{ $materia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Asignación</button>
                        <a href="{{ route('asignarMateria.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


