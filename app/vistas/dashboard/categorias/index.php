<?php
define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/header.php';
?>
<main>
    <div class="container-fluid px-4">
        <div class="card mb-4 mt-4 shadow-sm border-1 rounded-4 overflow-hidden">

            <!-- Header gris claro -->
            <div class="p-4 d-flex justify-content-between align-items-center" style="background-color:rgb(48, 48, 48); color: #343a40;">
                <h5 class="mb-0 fw-bold d-flex align-items-center gap-2 text-white">
                    <i class="fas fa-table me-2 fs-5 text-white"></i> Gestión de Categorias
                </h5>
                <button class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 36px; height: 36px; transition: transform 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.15)'"
                    onmouseout="this.style.transform='scale(1)'"
                    title="Nuevo"
                    data-bs-toggle="modal"
                    data-bs-target="#modalNuevaCategoria">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <!-- Cuerpo blanco -->
            <div class="card-body p-4 bg-white">
                <div class="table-responsive">
                    <table id="tablaCategorias" class="table table-hover table-striped table-bordered align-middle mb-0">
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
                                <?php foreach ($data as $index => $categoria):
                                    // Validación y saneamiento de datos
                                    $numero = $index + 1;
                                    $id = filter_var($categoria['id_categoria'] ?? '', FILTER_VALIDATE_INT);
                                    $nombre = htmlspecialchars($categoria['nombre'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $estado = htmlspecialchars($categoria['estado'] ?? '', ENT_QUOTES, 'UTF-8');
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $numero ?></td>
                                        <td class="text-center"><?= $nombre ?></td>
                                        <td class="text-center">
                                            <span class="badge <?= $estado == 'Activo' ? 'bg-success' : 'bg-secondary' ?>">
                                                <?= $estado ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <!-- Editar con ruta absoluta -->
                                            <button class="btn btn-warning btn-sm"
                                                title="Editar categoría"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarCategoria"
                                                onclick="cargarDatosEditar(<?= $id ?>, '<?= addslashes($nombre) ?>')">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            <!-- Eliminar con confirmación -->
                                            <form action="/directorio/rutas/rutas.php" method="POST" class="d-inline formEliminar">
                                                <input type="hidden" name="page" value="deleteCategory">
                                                <input type="hidden" name="delete" value="<?= $id ?>">
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de eliminar esta categoría?')"
                                                    title="Eliminar categoría">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-exclamation-circle me-2"></i> No hay categorías registradas
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div id="paginacionCategorias" class="mt-3 d-flex justify-content-center gap-2"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL PARA CREAR Y EDITAR -->
    <!-- Modal para Nueva Categoría -->
    <div class="modal fade" id="modalNuevaCategoria" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <header class="modal-header bg-dark text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i> Nueva Categoría
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </header>
                <main class="modal-body">
                    <form action="rutas.php?page=categories" method="POST" id="formInsertar">
                        <div class="mb-3">
                            <label class="form-label" for="nombreCategoria">Nombre</label>
                            <input type="text" class="form-control" id="nombreCategoria" name="name" required>
                        </div>

                        <footer class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary" name="action" value="insert">
                                <i class="fas fa-save me-1"></i> Guardar
                            </button>
                        </footer>
                    </form>
                </main>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Categoría -->
    <div class="modal fade" id="modalEditarCategoria" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <header class="modal-header bg-dark text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i> Editar Categoría
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </header>
                <main class="modal-body">
                    <form action="rutas.php?page=categories" method="POST" id="formEditar">
                        <input type="hidden" name="id" id="editId">
                        <div class="mb-3">
                            <label class="form-label" for="editNombreCategoria">Nombre</label>
                            <input type="text" class="form-control" id="editNombreCategoria" name="name" required>
                        </div>

                        <footer class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary" name="action" value="update">
                                <i class="fas fa-save me-1"></i> Guardar cambios
                            </button>
                        </footer>
                    </form>
                </main>
            </div>
        </div>
    </div>


</main>
<script>
    //paginacion
    const filasPorPagina = 5;

    document.addEventListener('DOMContentLoaded', function () {
        const tabla = document.getElementById('tablaCategorias');
        const cuerpo = tabla.querySelector('tbody');
        const filas = Array.from(cuerpo.querySelectorAll('tr'));
        const paginacion = document.getElementById('paginacionCategorias');

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

    //MODALS
    // * Vaciar
    // * Cargar datos en la modal
    document.getElementById('modalNuevaCategoria').addEventListener('hidden.bs.modal', function() {
        this.querySelector('form').reset();
    });

    function cargarDatosEditar(id, nombre) {
        document.getElementById('editId').value = id;
        document.getElementById('editNombreCategoria').value = nombre;
    }
</script>
<?php
include_once RUTA_BASE . '/App/vistas/dashboard/plantilla/footer.php';
?>