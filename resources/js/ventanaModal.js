import axios from "axios";
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
