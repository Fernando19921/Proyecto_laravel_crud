@extends('layouts/template')

@section('contenido')
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chair"></i> Aulas
                    </div>

                    <div class="card-body">
                        @if ($salones->isEmpty())
                            <div class="alert alert-info">No hay aulas registradas.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="w-10">Id</th>
                                            <th class="w-25">Nombre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salones as $salon)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $salon->nombre }}</td>
                                                <td>
                                                    <a href="{{ route('aulas.edit', $salon->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                                    <form id="formEliminar{{ $salon->id }}" action="{{ route('aulas.destroy', $salon->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion('{{ $salon->id }}', '{{ $salon->nombre }}')">Eliminar</button>
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
                        <a href="{{ route('aulas.create') }}" class="btn btn-success">Agregar Aula</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function confirmarEliminacion(aulaId, nombreAula) {
            if (confirm(`¿Está seguro de eliminar el registro del aula "${nombreAula}"?`)) {
                document.getElementById(`formEliminar${aulaId}`).submit();
            }
        }
    </script>
@endsection


