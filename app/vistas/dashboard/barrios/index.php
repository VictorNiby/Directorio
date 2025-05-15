<?php
define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/app/vistas/dashboard/plantilla/header.php';
?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <!-- Encabezado de la tarjeta -->
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3 ms-2">
                            <!-- <i class="material-symbols-rounded opacity-10 me-2">location_city</i> -->
                            Gestión de Barrios
                        </h6>
                        <button class="btn btn-sm btn-outline-light me-3 rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 32px; height: 38px;"
                            title="Nuevo barrio"
                            data-bs-toggle="modal"
                            data-bs-target="#modalNuevoBarrio">
                            <i class="material-symbols-rounded" style="font-size: 1.2rem;">add</i>
                        </button>
                    </div>
                </div>

                <!-- Cuerpo de la tarjeta -->
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">#</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 ps-2">Nombre</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Estado</th>
                                    <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-10 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data) && is_array($data)): ?>
                                    <?php foreach ($data as $index => $hood):
                                        $numero = $index + 1;
                                        $id = (int)($hood['id_barrio'] ?? 0);
                                        $nombre = htmlspecialchars($hood['nombre'] ?? '', ENT_QUOTES, 'UTF-8');
                                        $estado = htmlspecialchars($hood['estado'] ?? '', ENT_QUOTES, 'UTF-8');
                                    ?>
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm font-weight-bold"><?= $numero ?></span>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-sm font-weight-bold mb-0 text-capitalize"><?= $nombre ?></p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm <?= $estado === 'Activo' ? 'bg-gradient-success' : 'bg-gradient-secondary' ?>">
                                                    <?= ucfirst($estado) ?>
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button class="btn btn-sm bg-gradient-warning text-white mb-0 px-1 py-1 rounded-circle me-1"
                                                    style="width: 30px; height: 30px;"
                                                    title="Editar barrio"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarBarrio"
                                                    onclick="cargarDatosEditarBarrio(<?= $id ?>, '<?= addslashes($nombre) ?>', '<?= addslashes($estado) ?>')">
                                                    <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">edit</i>
                                                </button>
                                                <form action="/directorio/rutas/rutas.php" method="POST" class="d-inline formEliminar">
                                                    <input type="hidden" name="page" value="hoods">
                                                    <input type="hidden" name="deleteHood" value="<?= $id ?>">
                                                    <button type="submit" class="btn btn-sm bg-gradient-danger text-white mb-0 px-1 py-1 rounded-circle"
                                                        style="width: 30px; height: 30px;"
                                                        onclick="return confirm('¿Estás seguro de eliminar este barrio?')"
                                                        title="Eliminar barrio">
                                                        <i class="material-symbols-rounded mb-1" style="font-size: 1rem;">delete</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="align-middle text-center py-4">
                                            <span class="text-sm text-secondary">
                                                <i class="material-symbols-rounded opacity-10 me-1">info</i>
                                                No hay barrios registrados
                                            </span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div id="paginacionBarrios" class="mt-3 d-flex justify-content-center gap-1 font-weight-bold"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Barrio -->
<div class="modal fade" id="modalNuevoBarrio" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark shadow-dark">
                <h5 class="modal-title text-white">
                    <!-- <i class="material-symbols-rounded opacity-10 me-2">add_location</i> -->
                    Nuevo Barrio
                </h5>
                <button type="button" class="btn-close btn-close-white text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="rutas.php?page=hoods" method="POST">
                <div class="modal-body">
                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn bg-gradient-primary" name="action" value="insertHood">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Barrio -->
<div class="modal fade" id="modalEditarBarrio" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark shadow-dark">
                <h5 class="modal-title text-white">
                    <!-- <i class="material-symbols-rounded opacity-10 me-2">edit_location</i> -->
                    Editar Barrio
                </h5>
                <button type="button" class="btn-close btn-close-white text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="rutas.php?page=hoods" method="POST">
                <input type="hidden" name="id" id="editHoodId">
                <div class="modal-body">
                    <div class="input-group input-group-outline mb-3 is-filled">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" id="editHoodNombre" class="form-control" required value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn bg-gradient-primary" name="action" value="updateHood">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

</main>

<script>
    const filasPorPagina = 10
    document.addEventListener('DOMContentLoaded', function() {
        const cuerpo = document.querySelector('.table-responsive tbody');
        const filas = Array.from(cuerpo.querySelectorAll('tr'));
        const paginacion = document.getElementById('paginacionBarrios');

        // Si hay pocas filas, no mostramos paginación
        if (filas.length <= filasPorPagina) {
            paginacion.style.display = 'none';
            return;
        }

        let paginaActual = 1;
        const totalPaginas = Math.ceil(filas.length / filasPorPagina);

        function mostrarPagina(pagina) {
            paginaActual = pagina;
            const inicio = (pagina - 1) * filasPorPagina;
            const fin = inicio + filasPorPagina;

            filas.forEach((fila, i) => {
                fila.style.display = (i >= inicio && i < fin) ? 'table-row' : 'none';
            });

            actualizarPaginacion();
        }

        function actualizarPaginacion() {
            paginacion.innerHTML = '';
            paginacion.style.display = 'flex';

            // Botón Anterior
            if (paginaActual > 1) {
                const btnAnterior = document.createElement('button');
                btnAnterior.className = 'btn btn-sm btn-outline-dark';
                btnAnterior.innerHTML = '&laquo;';
                btnAnterior.addEventListener('click', () => mostrarPagina(paginaActual - 1));
                paginacion.appendChild(btnAnterior);
            }

            // Botones de páginas
            const inicioPaginas = Math.max(1, paginaActual - 2);
            const finPaginas = Math.min(totalPaginas, paginaActual + 2);

            for (let i = inicioPaginas; i <= finPaginas; i++) {
                const btn = document.createElement('button');
                btn.className = 'btn btn-sm ' + (i === paginaActual ? 'btn-dark' : 'btn-outline-dark');
                btn.textContent = i;
                btn.addEventListener('click', () => mostrarPagina(i));
                paginacion.appendChild(btn);
            }

            // Botón Siguiente
            if (paginaActual < totalPaginas) {
                const btnSiguiente = document.createElement('button');
                btnSiguiente.className = 'btn btn-sm btn-outline-dark';
                btnSiguiente.innerHTML = '&raquo;';
                btnSiguiente.addEventListener('click', () => mostrarPagina(paginaActual + 1));
                paginacion.appendChild(btnSiguiente);
            }
        }

        mostrarPagina(1);
    });

    function cargarDatosEditarBarrio(id, nombre, estado) {
        document.getElementById('editHoodId').value = id;
        document.getElementById('editHoodNombre').value = nombre;
        document.getElementById('editHoodEstado').value = estado;
    }
</script>

<?php include_once RUTA_BASE . '/app/vistas/dashboard/plantilla/footer.php'; ?>