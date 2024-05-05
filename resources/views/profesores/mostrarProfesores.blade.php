@extends('layouts/template')

@section('contenido')
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chalkboard-teacher"></i> Profesores
                    </div>

                    <div class="card-body">
                        @if ($profesores->isEmpty())
                            <div class="alert alert-info">No hay profesores registrados.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="w-10">Id</th>
                                            <th class="w-25">Nombre</th>
                                            <th class="w-25">Correo Electrónico</th>
                                            <th class="w-15">Teléfono</th>
                                            <th class="w-25">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($profesores as $profesor)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $profesor->nombre }}</td>
                                                <td>{{ $profesor->email }}</td>
                                                <td>{{ $profesor->telefono ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ route('profesores.edit', $profesor->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                                    <form id="formEliminar{{ $profesor->id }}" action="{{ route('profesores.destroy', $profesor->id) }}" method="POST" style="display: inline-block;">
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

                    <div class="card-footer text-right">
                        <a href="{{ route('profesores.create') }}" class="btn btn-success">Agregar Profesor</a>
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







