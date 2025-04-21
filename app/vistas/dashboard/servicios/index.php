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
                    <i class="fas fa-concierge-bell me-2 fs-5"></i> Gestión de Servicios
                </h5>
                <button class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 36px; height: 36px; transition: transform 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.15)'"
                    onmouseout="this.style.transform='scale(1)'"
                    title="Nuevo servicio"
                    data-bs-toggle="modal"
                    data-bs-target="#modalNuevoServicio">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <!-- Tabla -->
            <div class="card-body p-4 bg-white">
                <div class="table-responsive">
                    <table id="tablaServicios" class="table table-hover table-striped table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Título</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Usuario</th>
                                <th class="text-center">Categoría</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($services) && is_array($services)): ?>
                                <?php foreach ($services as $index => $service):
                                    $numero = $index + 1;
                                    $id = (int)($service['id_servicio'] ?? 0);
                                    $titulo = htmlspecialchars($service['titulo'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $descripcion = htmlspecialchars($service['descripcion'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $precio = htmlspecialchars($service['precio'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $usuario = htmlspecialchars($service['nombre'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $categoria = htmlspecialchars($service['categoria'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $estado = htmlspecialchars($service['estado'] ?? '', ENT_QUOTES, 'UTF-8');
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $numero ?></td>
                                        <td class="text-center"><?= $titulo ?></td>
                                        <td class="text-center"><?= $descripcion ?></td>
                                        <td class="text-center">$<?= number_format($precio, 0) ?></td>
                                        <td class="text-center text-capitalize"><?= $usuario ?></td>
                                        <td class="text-center text-capitalize"><?= $categoria ?></td>
                                        <td class="text-center">
                                            <span class="badge <?= $estado === 'Activo' ? 'bg-success' : 'bg-secondary' ?>">
                                                <?= ucfirst($estado) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm"
                                                title="Editar servicio"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarServicio"
                                                onclick="cargarDatosEditarServicio(
                                                    <?= $id ?>, 
                                                    '<?= addslashes($titulo) ?>', 
                                                    '<?= addslashes($descripcion) ?>',
                                                    '<?= addslashes($precio) ?>'
                                                )">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="/directorio/rutas/rutas.php" method="POST" class="d-inline formEliminar">
                                                <input type="hidden" name="page" value="services">
                                                <input type="hidden" name="deleteService" value="<?= $id ?>">
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de eliminar este servicio?')"
                                                    title="Eliminar servicio">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="bi bi-exclamation-circle me-2"></i> No hay servicios registrados
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div id="paginacionServicios" class="mt-3 d-flex justify-content-center gap-2"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODALES -->

    <!-- Nuevo Servicio -->
    <div class="modal fade" id="modalNuevoServicio" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="rutas.php?page=services" method="POST">
                    <header class="modal-header bg-dark text-white">
                        <h5 class="modal-title"><i class="fas fa-concierge-bell me-2"></i> Nuevo Servicio</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </header>
                    <main class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <input type="number" step="0.01" name="precio" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <select name="usuario_id" class="form-select" required>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user['id_usuario'] ?>"><?= htmlspecialchars($user['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categoría</label>
                            <select name="categoria_id" class="form-select" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id_categoria'] ?>"><?= htmlspecialchars($category['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </main>

                    <footer class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="action" value="insertService">Guardar</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>

    <!-- Editar Servicio -->
    <div class="modal fade" id="modalEditarServicio" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="rutas.php?page=services" method="POST">
                    <input type="hidden" name="id_servicio" id="editServicioId">
                    <header class="modal-header bg-dark text-white">
                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Editar Servicio</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </header>
                    <main class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" id="editServicioTitulo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" id="editServicioDescripcion" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <input type="number" step="0.01" name="precio" id="editServicioPrecio" class="form-control" required>
                        </div>
                    </main>

                    <footer class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="action" value="updateService">Guardar cambios</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    const filasPorPagina = 5;
    document.addEventListener('DOMContentLoaded', function() {
        const tabla = document.getElementById('tablaServicios');
        const cuerpo = tabla.querySelector('tbody');
        const filas = Array.from(cuerpo.querySelectorAll('tr'));
        const paginacion = document.getElementById('paginacionServicios');

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

    function cargarDatosEditarServicio(id, titulo, descripcion, precio) {
        document.getElementById('editServicioId').value = id;
        document.getElementById('editServicioTitulo').value = titulo;
        document.getElementById('editServicioDescripcion').value = descripcion;
        document.getElementById('editServicioPrecio').value = precio;
    }
</script>

<?php include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/footer.php'; ?>