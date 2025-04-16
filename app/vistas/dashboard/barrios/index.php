<?php

define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/header.php';

?>

<main>
    <div class="container-fluid px-4">
        <div class="card mb-4 mt-4 shadow-sm border-1 rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="p-4 d-flex justify-content-between align-items-center bg-dark text-white">
                <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
                    <i class="fas fa-city me-2 fs-5"></i> Gestión de Barrios
                </h5>
                <button class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 36px; height: 36px; transition: transform 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.15)'"
                    onmouseout="this.style.transform='scale(1)'"
                    title="Nuevo barrio"
                    data-bs-toggle="modal"
                    data-bs-target="#modalNuevoBarrio">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <!-- Tabla -->
            <div class="card-body p-4 bg-white">
                <div class="table-responsive">
                    <table id="tablaBarrios" class="table table-hover table-striped table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
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
                                        <td class="text-center"><?= $numero ?></td>
                                        <td class="text-center text-capitalize"><?= $nombre ?></td>
                                        <td class="text-center">
                                            <span class="badge <?= $estado === 'Activo' ? 'bg-success' : 'bg-secondary' ?>">
                                                <?= ucfirst($estado) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm"
                                                title="Editar barrio"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarBarrio"
                                                onclick="cargarDatosEditarBarrio(<?= $id ?>, '<?= addslashes($nombre) ?>', '<?= addslashes($estado) ?>')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="/directorio/rutas/rutas.php" method="POST" class="d-inline formEliminar">
                                                <input type="hidden" name="page" value="hoods">
                                                <input type="hidden" name="deleteHood" value="<?= $id ?>">
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de eliminar este barrio?')"
                                                    title="Eliminar barrio">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-exclamation-circle me-2"></i> No hay barrios registrados
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div id="paginacionBarrios" class="mt-3 d-flex justify-content-center gap-2"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODALES -->

    <!-- Nuevo Barrio -->
    <div class="modal fade" id="modalNuevoBarrio" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="rutas.php?page=hoods" method="POST">
                    <header class="modal-header bg-dark text-white">
                        <h5 class="modal-title"><i class="fas fa-city me-2"></i> Nuevo Barrio</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </header>
                    <main class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </main>

                    <footer class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="action" value="insertHood">Guardar</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>

    <!-- Editar Barrio -->
    <div class="modal fade" id="modalEditarBarrio" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="rutas.php?page=hoods" method="POST">
                    <input type="hidden" name="id" id="editHoodId">
                    <header class="modal-header bg-dark text-white">
                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Editar Barrio</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </header>
                    <main class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="name" id="editHoodNombre" class="form-control" required>
                        </div>
                    </main>

                    <footer class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="action" value="updateHood">Guardar cambios</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    const filasPorPagina = 5;
    document.addEventListener('DOMContentLoaded', function() {
        const tabla = document.getElementById('tablaBarrios');
        const cuerpo = tabla.querySelector('tbody');
        const filas = Array.from(cuerpo.querySelectorAll('tr'));
        const paginacion = document.getElementById('paginacionBarrios');

        if (filas.length <= filasPorPagina) return;

        let paginaActual = 1;
        const totalPaginas = Math.ceil(filas.length / filasPorPagina);

        function mostrarPagina(pagina) {
            paginaActual = pagina;
            const inicio = (pagina - 1) * filasPorPagina;
            const fin = inicio + filasPorPagina;

            filas.forEach((fila, i) => {
                fila.style.display = (i >= inicio && i < fin) ? '' : 'none';
            });

            actualizarPaginacion();
        }

        function actualizarPaginacion() {
            paginacion.innerHTML = '';

            for (let i = 1; i <= totalPaginas; i++) {
                const btn = document.createElement('button');
                btn.className = 'btn btn-sm ' + (i === paginaActual ? 'btn-primary' : 'btn-outline-primary');
                btn.textContent = i;
                btn.addEventListener('click', () => mostrarPagina(i));
                paginacion.appendChild(btn);
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

<?php include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/footer.php'; ?>
