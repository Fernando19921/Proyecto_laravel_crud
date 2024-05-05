@extends('layouts.template')

@section('contenido')
<main>
    <div class="container py-4">
        <div class='infoModal'></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2>Buscar Alumno con Axios</h2>
            <form action="{{ route('alumnos.index') }}" method="GET">
                <div class="form-row">
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="texto" id="searchInput" placeholder="Buscar" value="{{ $texto ?? '' }}">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" id="searchButton">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-right">
            <h2>Registrar Nuevo Alumno</h2>
            <a href="{{ url('alumnos/create') }}" class="btn btn-primary btn-sm">Nuevo Registro</a>
        </div>
    </div>
    <div id="mensajeNoResultados" style="display: none;">
        No se encontraron resultados.
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>id</th>
                <th>Matricula</th>
                <th>Nombre</th>
                <th>Fecha Nacimiento</th>
                <th>Telefono</th>
                <th>Email</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="resultsTable">
            @foreach($alumnos as $alumno)
            <tr>
                <td>{{ $alumno->id }}</td>
                <td>{{ $alumno->matricula }}</td>
                <td>{{ $alumno->nombre }}</td>
                <td>{{ $alumno->fecha_nacimiento }}</td>
                <td>{{ $alumno->telefono }}</td>
                <td>{{ $alumno->email }}</td>
                <td><a href="{{ url('alumnos/' . $alumno->id . '/edit') }}" class="btn btn-primary btn-sm">Editar</a></td>
                <td>
                    <form id="formEliminar{{ $alumno->id }}" action="{{ url('alumnos/' . $alumno->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion({{ $alumno->id }}, '{{ $alumno->nombre }}')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchButton').addEventListener('click', function() {
        var searchText = document.getElementById('searchInput').value;
        axios.get('{{ route("buscar-alumnos") }}', {
            params: {
                texto: searchText
            }
        })
        .then(function(response) {
            var tbody = document.getElementById('resultsTable');
            tbody.innerHTML = ''; // Clear the current table content
            if (response.data.data.length === 0) {
                document.getElementById('mensajeNoResultados').style.display = 'block';
            } else {
                document.getElementById('mensajeNoResultados').style.display = 'none';
            }
            response.data.data.forEach((alumno) => {
                var row = document.createElement('tr');
                row.innerHTML = `
                <td>${alumno.id}</td>
            <td>${alumno.matricula}</td>
            <td>${alumno.nombre}</td>
            <td>${alumno.fecha_nacimiento}</td>
            <td>${alumno.telefono}</td>
            <td>${alumno.email}</td>
            <td><a href="/alumnos/${alumno.id}/edit" class="btn btn-primary btn-sm">Editar</a></td>
            <td>
                <form id="formEliminar${alumno.id}" action="/alumnos/${alumno.id}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion(${alumno.id}, '${alumno.nombre}')">Eliminar</button>
                </form>
            </td>
            <td>
                <button type="button" class="btn btn-secondary btn-sm" onclick="window.history.back();">Volver atrás</button>
            </td>

                `;
                tbody.appendChild(row);
            });
        })
        .catch(function(error) {
            console.error(error);
        });
    });
});

function confirmarEliminacion(alumnoId, nombreAlumno) {
    if (confirm(`¿Está seguro de eliminar el registro del alumno "${nombreAlumno}"?`)) {
        document.getElementById(`formEliminar${alumnoId}`).submit();
    }
}

document.addEventListener("click", (e) => {
    if (e.target.matches("td:not(:last-child)")) { 
        const fila = e.target.parentElement;
        mostrarModal(
            fila.children[0].textContent, // ID
            fila.children[1].textContent, // Matricula
            fila.children[2].textContent, // Nombre
            fila.children[3].textContent, // Fecha Nacimiento
            fila.children[4].textContent, // Telefono
            fila.children[5].textContent  // Email
        );
    }
});

function mostrarModal(id, matricula, nombre, fechaNacimiento, telefono, email) {
    let modalHTML = `
        <div class="modal fade" id="modal-${id}" tabindex="-1" role="dialog" aria-labelledby="modalLabel-${id}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel-${id}">Detalles del Alumno</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Matrícula:</strong> ${matricula}</p>
                        <p><strong>Nombre:</strong> ${nombre}</p>
                        <p><strong>Fecha de Nacimiento:</strong> ${fechaNacimiento}</p>
                        <p><strong>Teléfono:</strong> ${telefono}</p>
                        <p><strong>Email:</strong> ${email}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    let modalContainer = document.querySelector(".infoModal");
    modalContainer.innerHTML = modalHTML;
    var modal = new bootstrap.Modal(document.getElementById(`modal-${id}`));
    modal.show();
}
</script>
@endsection
