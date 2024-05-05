@extends('layouts/template')

@section('contenido')
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-book"></i> Materias <!-- Cambiado el icono a un libro -->
                    </div>

                    <div class="card-body">
                        @if ($materias->isEmpty())
                            <div class="alert alert-info">No hay materias registradas.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="w-10">Id</th>
                                            <th class="w-25">Nombre</th>
                                            <th class="w-15">Descripción</th> <!-- Cambiado a Descripción -->
                                            <th class="w-25">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($materias as $materia)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $materia->nombre }}</td>
                                                <td>{{ $materia->descripcion }}</td>
                                                <td>
                                                    <a href="{{ route('materias.edit', $materia->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                                    <form id="formEliminar{{ $materia->id }}" action="{{ route('materias.destroy', $materia->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion('{{ $materia->id }}', '{{ $materia->nombre }}')">Eliminar</button>
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
                        <a href="{{ route('materias.create') }}" class="btn btn-success">Agregar Materia</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function confirmarEliminacion(materiaId, nombreMateria) {
            if (confirm(`¿Está seguro de eliminar el registro de la materia "${nombreMateria}"?`)) {
                document.getElementById(`formEliminar${materiaId}`).submit();
            }
        }
    </script>
@endsection
