@extends('layouts.template')

@section('contenido')
<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chalkboard-teacher opacity-10"></i> Asignar Materia Profesor
                </div>

                <div class="card-body">
                    @if ($profesores->isEmpty())
                        <div class="alert alert-info">No hay profesores registrados.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="w-10">ID</th>
                                        <th class="w-30">Profesor</th>
                                        <th class="w-50">Materias Asignadas</th>
                                        <th class="w-10">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($profesores as $profesor)
                                        <tr>
                                            <td>{{ $profesor->id }}</td>
                                            <td>{{ $profesor->nombre }}</td>
                                            <td>
                                                @forelse ($profesor->materias as $materia)
                                                    {{ $materia->nombre }}@if (!$loop->last), @endif
                                                @empty
                                                    Sin materias asignadas
                                                @endforelse
                                            </td>
                                            <td>
                                                <a href="{{ route('asignarMateria.edit', $profesor->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                                <form id="formEliminar{{ $profesor->id }}" action="{{ route('asignarMateria.destroy', $profesor->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion('{{ $profesor->id }}', '{{ $profesor->nombre }}')">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                
                <div class="card-footer">
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-6"> <!-- Adjust the column width as needed -->
                            @if (!$profesores->isEmpty())
                                <a href="{{ route('asignarMateria.create') }}" class="btn btn-success">
                                </a>
                            @endif
                        </div>
                        <div class="col-md-6"> <!-- Adjust the column width as needed -->
                            <a href="{{ route('asignarMateria.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Crear Registro
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function confirmarEliminacion(profesorId, nombreProfesor) {
        if (confirm(`¿Está seguro de eliminar el registro del profesor "${nombreProfesor}"?`)) {
            document.getElementById(`formEliminar${profesorId}`).submit();
        }
    }
</script>
@endsection

